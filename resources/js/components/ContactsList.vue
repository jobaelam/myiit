<template>
    <div class="contacts-list">
        <ul>
            <li v-for="contact in contacts"></li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            contacts: {
                type: Array,
                default: []
            }
        }
    }
</script>
