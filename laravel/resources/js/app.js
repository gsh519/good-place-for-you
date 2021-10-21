import './bootstrap'
import Vue from 'vue'
import PostLike from './components/PostLike.vue'
import PostTagsInput from './components/PostTagsInput.vue'

const app = new Vue({
  el: '#app',
  components: {
    PostLike,
    PostTagsInput,
  }
})
