<template>

    <div class="card">
        <div class="card-content">
            <span class="card-title">{{title}}</span>
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{threads}}</th>
                    <th>{{replies}}</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Tópico legal que vamos puxar do laravel em realtime</td>
                    <td>3</td>
                    <td><a href="/threads/1">{{open}}</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    export default {
        props: [
            'title',
            'threads',
            'replies',
            'open'
        ],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
