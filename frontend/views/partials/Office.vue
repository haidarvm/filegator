<template>
  <div>
    <div class="modal-card">
      <div class="modal-card-body preview">
        <strong>{{ currentItem.name }}</strong>
        <a class="is-block name" @click="download(currentItem.path)">
          {{ currentItem.name }}
        </a>
        <iframe :src="iframeSrc"></iframe>
      </div>
    </div>
  </div>
</template>

<script>
import _ from 'lodash'
export default {
  name: 'Office',
  props: [ 'item' ],
  data() {
    return {
      content: '',
      currentItem: '',
      lineNumbers: true,
      iframeSrc: 'https://docs.google.com/viewerng/viewer?url=' + this.getOfficePhp(this.item.path) + '&embedded=true',
    }
  },
  computed: {
    images() {
      return _.filter(this.$store.state.cwd.content, o => this.isOffice(o.name))
    },
  },
  mounted() {
    this.currentItem = this.item
  },
  methods: {
    // googleDocs(path) {
    //   const officePhp = this.getOfficePhp(path)
    //   console.log('office path nya ='+ officePhp)
    //   // return 'https://docs.google.com/viewerng/viewer?url=https://play.hyd-ant.app/invoice.docx&embedded=true'
    //   // return 'https://view.officeapps.live.com/op/embed.aspx?src=' + officePhp
    //   return 'https://docs.google.com/viewerng/viewer?url=' + officePhp + '&embedded=true'
    // },
    download(path) {
      console.log('downloading' + this.getDownloadLink(path))
      window.open(this.getDownloadLink(path), '_blank')
    },
    itemClick(item) {
        this.download(item)
    }
  },
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

iframe {
    background: #000;
    border: none;
    width: 1000px;
    height: 800px;
}

</style>
