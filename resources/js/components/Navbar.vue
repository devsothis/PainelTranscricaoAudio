<template>
  <div
    class="mx-auto overflow-hidden"
    height="800"
  >
    <v-app-bar
      color="#234164"
      absolute
      dark
    >
      <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>
      <div class="mx-auto"><v-toolbar-title>Dashboard Transcrição de Audio</v-toolbar-title></div>
    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      absolute
      temporary
    >
      <v-list
        nav
        dense
      >
        <v-list-item-group
          v-model="group"
          active-class="deep-purple--text text--accent-4"
        >
          <v-list-item>
            <v-list-item-icon>
              <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>


<script>
export default {
    mounted(){

    },
    data(){
        return {
            drawer:false,
            group:false
        }
    }
}
</script>
