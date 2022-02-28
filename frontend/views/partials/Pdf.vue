<template>
  <div>
    <div class="modal-card">
      <div class="modal-card-body preview">
        <strong>{{ currentItem.name }}</strong>
        <a class="is-block name" @click="download(currentItem.path)">
          {{ currentItem.name }}
        </a>
        <object type="application/pdf" :data="pdfSrc(currentItem.path)" width="1500" height="800"></object>
      </div>
    </div>
  </div>
</template>

<script>
import _ from 'lodash'
export default {
  name: 'Pdf',
  props: [ 'item' ],
  data() {
    return {
      content: '',
      currentItem: '',
      lineNumbers: true,
    }
  },
  computed: {
    images() {
      return _.filter(this.$store.state.cwd.content, o => this.isPdf(o.name))
    },
  },
  mounted() {
    this.currentItem = this.item
  },
  methods: {
    pdfSrc(path) {
      return this.getDownloadLink(path)
    },
    download(path) {
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

</style>
