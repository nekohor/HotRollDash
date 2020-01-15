<template>
  <div class="app-container">
    <el-row :gutter="24">
      <el-col>
        <div>
          <upload-excel-component :on-success="handleSuccess" :before-upload="beforeUpload" />
        </div>
      </el-col>
    </el-row>
    <el-row :gutter="24">
      <el-col :span="24">
        <div class="el-transfer">
          <el-transfer v-model="transferValue" :titles="['已导入的计划', '待评估的计划']" :data="transferData" />
        </div>
      </el-col>
    </el-row>

    <el-row :gutter="24">
      <el-col :span="4">
        <el-button type="primary" plain @click="handleCalculateYield">计算班组产量</el-button>
      </el-col>
      <el-col :span="20">
        <el-table
          class="calc-area"
          :data="resultData"
          border
          highlight-current-row
          style="width: 100%;margin-top:20px;"
        >
          <el-table-column v-for="item of resultHeader" :key="item" :prop="item" :label="item" />
        </el-table>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import UploadExcelComponent from '@/components/UploadExcel/index.vue';
import calcYield from '@/api/article';

export default {
  name: 'PiecesAnHour',
  components: { UploadExcelComponent },
  data() {
    return {
      dataTables: {},
      dataTable: [],
      tableHeader: [],

      transferData: [],
      transferValue: [],
      selectedPlanIds: [],

      resultData: [],
      resultHeader: [],
    };
  },
  methods: {
    beforeUpload(file) {
      const isLt1M = file.size / 1024 / 1024 < 1;
      if (isLt1M) {
        return true;
      }
      this.$message({
        message: '请不要上传大于1M的Excel文件',
        type: 'warning',
      });
      return false;
    },
    handleSuccess({ results, header }) {
      const planId = results[0]['作业计划号'];
      const millLine = this.getMillLine(planId.substr(0, 4));

      this.transferData.unshift({
        key: this.transferData.length,
        label: millLine + ' ' + planId,
      });

      this.dataTables[planId] = results;
      this.selectedPlanIds.unshift(planId);

      this.tableHeader = header;
    },
    getMillLine(tag) {
      if (tag === 'HSM1') {
        return '2250';
      } else if (tag === 'HSM2') {
        return '1580';
      } else {
        return '非2250/1580';
      }
    },
    getRelatedInputData() {
      const data = [];

      this.selectedPlanIds.forEach(planId => {
        const dataTable = this.dataTables[planId];
        dataTable.forEach(record => {
          data.push(this.getRelatedInputElement(record));
        });
      });
      return data;
    },
    getRelatedInputElement(record) {
      const ele = {};
      ele['steel_grade'] = record['成品钢种'];
      ele['thk'] = parseFloat(record['成品规格'].split('*')[0]);
      ele['wid'] = record['头部宽度'];
      return ele;
    },

    getGTWMap(data) {
      const m = new Map();
      data.forEach(record => {
        const gtwTag = this.getGTWTag(record);
        if (m.has(gtwTag)) {
          const gtwNum = m.get(gtwTag);
          m.set(gtwTag, gtwNum + 1);
        } else {
          m.set(gtwTag, 1);
        }
      });
      return m;
    },
    getGTWTag(record) {
      return record['steel_grade'] + '_' + record['thk'] + '_' + record['wid'];
    },
    getCalcInputData() {
      const inputData = [];
      const relatedData = this.getRelatedInputData();
      const gtwMap = this.getGTWMap(relatedData);

      gtwMap.forEach((value, key, map) => {
        const keys = key.split('_');
        const steel_grade = keys[0];
        const thk = parseFloat(keys[1]);
        const wid = parseInt(keys[2]);
        const count = value;

        inputData.push({
          steel_grade: steel_grade,
          thk: thk,
          wid: wid,
          count: count,
        });
      });

      return inputData;
    },
    handleCalculateYield() {
      console.log(this.selectedPlanIds);

      const hsmTags = this.selectedPlanIds.map(planId => {
        return this.getMillLine(planId.substr(0, 4));
      });
      const lines = Array.from(new Set(hsmTags));
      if (lines.length > 1) {
        this.$message({
          message: '请勿跨产线计算',
          type: 'warning',
        });
        return false;
      }

      const line = lines[0];
      console.log(line);
      console.log(this.getCalcInputData());
    },
    calcuateYield(line, inputData) {
      const postForm = {
        line: line,
        inputData: inputData,
      };
      calcYield(postForm).then(response => {
        console.log(response.data);
        this.list1 = response.data.items.splice(0, 5);
        this.list2 = response.data.items;
      });
    },
  },
};
</script>

<style scoped>
.el-transfer {
  /* text-align: center; */
  width: 600px;
  height: 280px;
  /* position: absolute; */
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  margin-top: 1%;
}
.el-row {
  margin-bottom: 10px;
}
.el-button {
  margin-top: 30px;
}
.el-table {
  width: 600px;
  height: 280px;
}
</style>
