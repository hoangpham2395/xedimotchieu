<template>
	<div class="conversation">
		<h1>{{ contact ? contact.name : 'Hãy chọn người để liên hệ' }}</h1>
		<MessagesFeed :contact="contact" :messages="messages"/>
		<MessageComposer @send="sendMessage"/>
	</div>
</template>

<script>
	import MessagesFeed from './MessagesFeed';
	import MessageComposer from './MessageComposer';

	export default {
		props: {
			contact: {
				type: Object,
				default: null
			},
			messages: {
				type: Array,
				default: []
			}
		},
		methods: {
			sendMessage(text) {
				if (!this.contact) {
					return;
				}

				axios.post('/chat/conversation/send', {
					user_to_id: this.contact.id,
					content: text
				}).then((response) => {
					this.$emit('new', response.data);
				});
			}
		},
		components: {MessagesFeed, MessageComposer}
	}
</script>

<style lang="scss" scoped>
.conversation {
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    h1 {
        font-size: 18px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgray;
        opacity: 0.8;
    }
}
</style>