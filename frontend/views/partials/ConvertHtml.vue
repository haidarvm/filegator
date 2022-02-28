<template>
  <div>
    <div class="modal-card">
      <div class="modal-card-body preview">
        <strong>haidar cek{{ currentItem.name }}</strong>
        <a class="is-block name" @click="download(currentItem)">
          {{ currentItem.name }}
        </a>
        <div>
          <p>{{ rendering }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../../api/api'
import _ from 'lodash'
import mammoth from 'mammoth'

export default {
  name: 'ConvertHtml',
  props: [ 'item' ],
  data() {
    return {
      content: '',
      htmlOutput: '',
      rendering: '',
      currentItem: 'Output appears here.',
      lineNumbers: true,
    }
  },
  computed: {
    images() {
      return _.filter(this.$store.state.cwd.content, o => this.isOffice(o.name))
    },
  },
  mounted() {
    this.currentItem = this.item
    this.getWordText(this.currentItem.path)
  },
  methods: {
     getWordText (path) {
        console.log('item path : '+path )
        var files = this.getLink(path)
        console.log('filenya : '+ files)
        api.getFile({
          path: path,
        }).then((res) => {
          mammoth.convertToHtml({ arrayBuffer : new  Uint8Array (res) }).then( ( resultObject ) => {
                this.$nextTick( () => {
                  this.rendering = resultObject.value
              })
          })
        })
        .catch(error => this.handleError(error))
    },
  download(item) {
    window.open(this.getDownloadLink(item.path), '_blank')
  }
  }
}
</script>

<style scoped>
@media (min-width: 1100px) {
  .modal-card {
    width: 100%;
    min-width: 640px;
  }
}

object {
  height: 700px;
}

.mainbox {
  height: 70vh;
  display:flex;
  justify-content:center;
  align-items:center;
}

.mainimg {
  max-width:100%;
  max-height:100%;
}

.sidebox {
  overflow-y:auto;
  height: 70vh;
}

.sidebox {
  border-left: 1px solid #dbdbdb;
}

.sidebox img {
  padding: 5px 0 5px 0;
}

</style>
