<template>
    <div class="card-group">
        <div class="card horizontal" v-for="data in replies_response.data"
             :class="{'lime lighten-4': data.highlighted }">
            <div class="card-image">
                <img :src="data.user.photo_url" :alt="data.user.name" v-if="data.user.photo_url">
                <div class="no-image" v-if="!data.user.photo_url">{{data.user.name}}</div>
            </div>
            <div class="card-stacked">
                <div class="card-content">
                <span class="card-title">
                    {{data.user.name}} {{replied}}
                </span>
                    <blockquote>
                        {{data.body}}
                    </blockquote>
                </div>
                <div class="card-action" v-if="logged.role === 'admin'">
                    <a :href="'/replies/' + data.id + '/highlight'">{{highlight}}</a>
                </div>
            </div>
        </div>

        <div class="card grey lighten-4" v-if="isOpen">
            <div class="card-content">
                <span class="card-title">
                    {{reply}}
                </span>
                <form @submit.prevent="save()">
                    <div class="input-field">
                        <textarea class="materialize-textarea" :placeholder="yourAnswer" rows="10"
                                  v-model="reply_to_save.body"></textarea>
                    </div>
                    <button type="submit" class="btn red accent-2">{{send}}</button>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
    .no-image {
        background:url(data:image/jpeg;base64,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) no-repeat left center;
        background-size: 250px 250px;
        width: 250px;
        height: 250px;
        display: block;
        text-indent: -999px;
    }
</style>
<script>
    export default {
        props: [
            'replied',
            'reply',
            'yourAnswer',
            'send',
            'threadId',
            'highlight',
            'isOpen'
        ],
        methods: {
            getReplies() {
                window.axios.get('/replies/' + this.thread_id).then((response) => {
                    this.replies_response = response.data;
                });
            },
            save() {
                window.axios.post('/replies/' + this.thread_id, this.reply_to_save).then(() => {
                    this.getReplies();
                });
            }
        },
        data() {
            return {
                logged: window.user,
                replies_response: [],
                thread_id: this.threadId,
                reply_to_save: {
                    body: '',
                    thread_id: this.threadId
                }
            }
        },
        mounted() {
            this.getReplies();
            Echo.channel('new.reply.' + this.thread_id).listen('NewReply', (e) => {
                if (e.reply) {
                    this.getReplies();
                }
            });
        }
    }
</script>
