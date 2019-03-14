<?php 

namespace App\Http\Controllers\Base;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use Storage;

/**
 * 
 */
class FrontendController extends BaseController
{
    public function __construct()
    {

    }

    protected function _prepareData()
    {
        $params['alias'] = $this->getAlias();
        return $params;
    }

    protected function _prepareIndex()
    {
        $params = [];
        $params = array_merge($params, $this->_prepareData());
        return $params;
    }

    protected function _prepareCreate()
    {
        $params = [];
        $params = array_merge($params, $this->_prepareData());
        return $params;
    }

    protected function _prepareEdit()
    {
        $params['alias'] = $this->getAlias();
        $params = array_merge($params, $this->_prepareData());
        return $params;
    }

    protected function _prepareShow()
    {
        $params['alias'] = $this->getAlias();
        $params = array_merge($params, $this->_prepareData());
        return $params;
    }

    protected function _prepareStore()
    {
        // Get current admin
        $params['ins_id'] = frontendGuard()->user()->id;
        // Get file input if exist
        if (Session::has('current_file_field')) {
            $fileName = date('YmdHis') . '_' . Session::get('current_file_name');
            $params[Session::get('current_file_field')] = getConfig('url_media_frontend'). '/' .$this->getAlias() . '/' . $fileName;
        }
        return $params;
    }

    protected function _prepareUpdate()
    {
        // Get current admin
        $params['upd_id'] = frontendGuard()->user()->id;
        // Get file input if exist
        if (Session::has('current_file_field')) {
            $fileName = date('YmdHis') . '_' . Session::get('current_file_name');
            $params[Session::get('current_file_field')] = getConfig('url_media_frontend'). '/' .$this->getAlias() . '/' . $fileName;
        }
        return $params;
    }

    public function index()
    {
        $params = $this->_prepareIndex();
        $entities = $this->getRepository()->getListForFrontend(Input::all());
        return view('frontend.' . $this->getAlias() . '.index', compact('entities', 'params'));
    }

    public function show($id)
    {
        $params = $this->_prepareShow();
        $entity = $this->getRepository()->findById($id);
        // Check id
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }
        return view('frontend.' . $this->getAlias() . '.show', compact('entity', 'params'));
    }

    public function create()
    {
        $params = $this->_prepareCreate();
        return view('frontend.' . $this->getAlias() . '.create', compact('params'));
    }

    public function edit($id)
    {
        $params = $this->_prepareEdit();
        $entity = $this->getRepository()->findById($id);
        // Check id
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }
        return view('frontend.' . $this->getAlias() . '.edit', compact(['entity', 'params']));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // Upload file to tmp folder if exist
        $this->_uploadToTmpIfExist($request);

        // Validate
        $valid = $this->getValidator()->validateCreate($data);
        if (!$valid) {
            return redirect()->back()->withErrors($this->getValidator()->errors())->withInput();
        }

        // Create
        $data = array_merge($data, $this->_prepareStore());
        DB::beginTransaction();
        // try {
            $this->getRepository()->create($data);
            // Move file to medias if exist
            $this->_moveToMediasIfExist($data);
            DB::commit();

            Session::flash('success', getMessage('create_success'));
            return redirect()->route('frontend.' . $this->getAlias() . '.index');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     logError($e);
        // }
        // Create failed
        $this->_deleteFileInTmpIfExist();
        return redirect()->route('frontend.' . $this->getAlias() . '.index')->withErrors(['create_failed' => getMessage('create_failed')]);
    }

    public function update(Request $request, $id)
    {
        // Check id
        $entity = $this->getRepository()->findById($id);
        if (empty($entity)) {
            return redirect()->route('frontend.' . $this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }

        $data = $request->all();

        // Upload file to tmp folder if exist
        $this->_uploadToTmpIfExist($request);

        // Validate
        $valid = $this->getValidator()->validateUpdate($data, $id);
        if (!$valid) {
            return redirect()->back()->withErrors($this->getValidator()->errors())->withInput();
        }

        // Update
        $data = array_merge($data, $this->_prepareUpdate());
        DB::beginTransaction();
        try {
            $this->getRepository()->update($data, $id);
            // Move file to medias if exist
            $this->_moveToMediasIfExist($data);
            DB::commit();
            Session::flash('success', getMessage('update_success'));
            return redirect()->route('frontend.' . $this->getAlias() . '.index');
        } catch (\Exception $e) {
            DB::rollBack();
            logError($e);
        }
        // Update failed
        $this->_deleteFileInTmpIfExist();
        return redirect()->route('frontend.' . $this->getAlias() . '.index')->withErrors(['update_failed' => getMessage('update_failed')]);
    }

    public function destroy($id)
    {
        // Check id
        $entity = $this->getRepository()->findById($id);
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }
        // Delete
        $data['del_flag'] = getConstant('DEL_FLAG.DELETED', 1);
        $data['upd_id'] = 1;
        DB::beginTransaction();
        try {
            $this->getRepository()->update($data, $id);
            //$this->_deleteFileIfExist();
            DB::commit();
            Session::flash('success', getMessage('delete_success'));
            return redirect()->route('frontend.' . $this->getAlias() . '.index');
        } catch(\Exception $e) {
            DB::rollBack();
            logError($e);
        }
        // Delete failed
        return redirect()->route('frontend.' . $this->getAlias() . '.index')->withErrors(['delete_failed' => getMessage('delete_failed')]);
    }

    protected function _uploadToTmpIfExist($request)
    {
        // Get value of file input
        $hiddenName = getConstant('FILE_INPUT_NAME');
        $fileField = $request->input($hiddenName) ? $request->input($hiddenName) : $hiddenName;

        // Check exist
        if (!$request->hasFile($fileField)) {
            return;
        }

        $fileName = $request->file($fileField)->getClientOriginalName();
        $conntentFile = file_get_contents($request->file($fileField)->getRealPath());
        // Upload file to tmp folder
        try {
            Storage::disk('tmp')->put($fileName, $conntentFile);
            // Set sesion of file
            Session::put('current_file_name', $fileName);
            Session::put('current_file_field', $fileField);
        } catch(\Exception $e) {

        }
    }

    protected function _moveToMediasIfExist($data)
    {
        if (!Session::has('current_file_field') || !$data[Session::get('current_file_field')]) {
            return;
        }

        $oldPath = getConfig('url_tmp') . '/' . Session::get('current_file_name');
        $newPath = $data[Session::get('current_file_field')];
        // Get file name same _prepareStore
        Storage::disk('public_path')->move($oldPath, $newPath);

        // Delete session
        Session::forget('current_file_field');
        Session::forget('current_file_name');
    }

    protected function _deleteFileInTmpIfExist()
    {
        if (!Session::has('current_file_field')) {
            return;
        }
        Storage::disk('tmp')->delete(Session::get('current_file_name'));

        // Delete session
        Session::forget('current_file_field');
        Session::forget('current_file_name');
    }

    protected function _deleteFileIfExist($id)
    {
        return true;
    }
}
?>