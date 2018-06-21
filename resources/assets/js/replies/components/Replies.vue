<template>
    <div class="card-group">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    Erik {{replied}}
                </span>
                <blockquote>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus consectetur culpa dicta,
                    dolores, doloribus esse eveniet inventore ipsa iure magnam mollitia nostrum obcaecati, odit
                    perspiciatis quae quisquam tempora ut veniam.
                </blockquote>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    Erik {{replied}}
                </span>
                <blockquote>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus consectetur culpa dicta,
                    dolores, doloribus esse eveniet inventore ipsa iure magnam mollitia nostrum obcaecati, odit
                    perspiciatis quae quisquam tempora ut veniam.
                </blockquote>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    Erik {{replied}}
                </span>
                <blockquote>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus consectetur culpa dicta,
                    dolores, doloribus esse eveniet inventore ipsa iure magnam mollitia nostrum obcaecati, odit
                    perspiciatis quae quisquam tempora ut veniam.
                </blockquote>
            </div>
        </div>

        <div class="card grey lighten-4">
            <div class="card-content">
                <span class="card-title">
                    {{reply}}
                </span>
                <form action="">
                    <div class="input-field">
                        <textarea class="materialize-textarea" :placeholder="yourAnswer" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn red accent-2">{{send}}</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'replied',
            'reply',
            'yourAnswer',
            'send'
        ]
    }
</script>
