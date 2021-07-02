<template>
  <v-container class="mt-5" fluid style="height: 100vh">
    <v-layout justify-center>
      <v-row  class="full-height mt-5 pa-2 d-flex flex-column" v-if="spinner">
        <v-progress-circular
          indeterminate
          color="#9B2524"
        ></v-progress-circular>
      </v-row>

      <v-row v-if="!spinner" class="full-height mt-5 pa-2 d-flex flex-column">
        <v-row>
          <v-col cols="12" lg="6">
            <v-menu
              data-app
              ref="menu1"
              v-model="menu1"
              :close-on-content-click="false"
              transition="scale-transition"
              offset-y
              max-width="290px"
              min-width="auto"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="dateFormatted"
                  label="DE"
                  persistent-hint
                  prepend-icon="mdi-calendar"
                  v-bind="attrs"
                  @blur="date = parseDate(dateFormatted)"
                  @click="menu1 = true"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                v-model="date"
                no-title
                @input="menu1 = false"
              ></v-date-picker>
            </v-menu>
          </v-col>
          <v-col cols="12" lg="6">
            <v-menu
              data-app
              ref="menu2"
              v-model="menu2"
              :close-on-content-click="false"
              transition="scale-transition"
              offset-y
              max-width="290px"
              min-width="auto"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="dateFormatted2"
                  label="ATÉ"
                  persistent-hint
                  prepend-icon="mdi-calendar"
                  v-bind="attrs"
                  @blur="date2 = parseDate(dateFormatted2)"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                v-model="date2"
                no-title
                @input="menu2 = false"
              ></v-date-picker>
            </v-menu>
          </v-col>
        </v-row>
        <v-card cols="12" sm="6" md="8">
          <v-card>
            <v-card-title>
              <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
              ></v-text-field>
            </v-card-title>
            <v-data-table
              :items-per-page="10"
              :headers="headers"
              :items="items"
              :search="search"
            ></v-data-table>
          </v-card>
        </v-card>
      </v-row>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  props: ["vistorias"],
  mounted() {
    this.items = [...this.vistorias];
    this.items = this.items.map((item) => {
      return {
        ...item,
        possuiAudio: item.hasAudio == 0 ? "NÃO" : "SIM",
      };
    });
  },
  computed: {
    computedDateFormatted() {
      return this.formatDate(this.date);
    },
    axiosParams() {
      const params = new URLSearchParams();
      params.append("de", this.dateFormatted);
      params.append("ate", this.dateFormatted2);
      return params;
    },
  },

  watch: {
    date(val) {
      this.dateFormatted = this.formatDate(this.date);
      this.filtrarPorData();
    },
    date2(val) {
      this.dateFormatted2 = this.formatDate(this.date2);
      this.filtrarPorData();
    },
  },
  methods: {
    formatDate(date) {
      if (!date) return null;
      const [year, month, day] = date.split("-");
      return `${month}/${day}/${year}`;
    },
    async filtrarPorData() {
      this.spinner = true;
      console.log(this.axiosParams);
      let request = await axios.get(`/dashboard/filtrardata`, {
        params: this.axiosParams,
      });
      let items = await request.data;
      this.items = items.map((item) => {
        return {
          ...item,
          possuiAudio: item.hasAudio == 0 ? "NÃO" : "SIM",
        };
      });
      this.spinner = false;
    },
    parseDate(date) {
      if (!date) return null;
      const [month, day, year] = date.split("/");
      return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
    },
  },
  data: (vm) => ({
    date: new Date().toISOString().substr(0, 10),
    date2: new Date().toISOString().substr(0, 10),
    dateFormatted: vm.formatDate(new Date().toISOString().substr(0, 10)),
    dateFormatted2: vm.formatDate(new Date().toISOString().substr(0, 10)),
    menu1: false,
    menu2: false,
    spinner: false,
    search: "",
    items: [],
    headers: [
      { text: "Possui Audio", value: "possuiAudio" },
      { text: "Nome", value: "nome" },
      { text: "createdAt", value: "createdAt" },
      { text: "updatedAt", value: "updatedAt" },
      { text: "Record Path", value: "record_path" },
      { text: "Criptografia", value: "criptografia" },
    ],
  }),
};
</script>

<style scoped>
.full-height {
  height: 100%;
}

div > .v-progress-circular{
   position:absolute;
   left:50%;
   top:45%;
}

</style>
