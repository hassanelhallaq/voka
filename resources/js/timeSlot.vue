<template>
  <div class="table-calender container-fluid">
    <div class="row mt-5">
      <div class="col-md-3"></div>
      <div class="col-md-9">
        <table class="table table-dark table-hover">
          <thead>
            <tr>
              <th v-for="(hour, i) in avaTables.hours" :key="i">{{ hour }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="table in avaTables.tables" :key="table.id">
              <td v-for="(available, index) in table.availability" :key="index">
                <div
                  class="reservations-wrap"
                  v-if="available"
                  @click="getTableId(table.id)"
                >
                  <div
                    class="status rounded-3"
                    :class="{
                      'bg-success': available,
                      'bg-secondary': !available,
                    }"
                    :data-id="table.id"
                  >
                    <span @click="printAvailableHours(table.id)">
                      {{ table.name }}
                    </span>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      avaTables: {
        hours: [],
        tables: [],
      },
    };
  },
  methods: {
    getTableId(tableId) {
      console.log(tableId);
    },
    async fetchData() {
        try {
        const branchId = authenticatedUserId;
        const response = await axios.get("https://vkoa.net/api/time-slots", {
                    params: {
                        branch_id: branchId,
                    },
        });        this.avaTables.hours = response.data.hours;
        this.avaTables.tables = response.data.tables;
        console.log("succes");
      } catch (error) {
        console.error("Failed to fetch data:", error);
      }
    },
    printAvailableHours(tableId) {
      const table = this.avaTables.tables.find((t) => t.id === tableId);
      if (table) {
        const availableHours = this.avaTables.hours
          .filter((hour, index) => table.availability[index])
          .map((hour) => hour);

        console.log(
          "Available hours for Table " + table.name + ":",
          availableHours
        );
      }
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>
<style lang="scss">
body {
  height: 100vh;
  background-color: #111315 !important;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #ffffff;
  background-color: #111315;
}
nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
.table-calender {
  direction: rtl;
}
.status {
  height: 100px;
}
.reservations-wrap {
  cursor: pointer;
}
</style>
