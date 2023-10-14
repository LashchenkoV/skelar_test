<template xmlns="http://www.w3.org/1999/html">
  <v-app-bar
      color="primary"
      prominent
  >
    <v-icon icon="mdi-menu" variant="text" class="m-5" @click.stop="drawer = !drawer"></v-icon>
    <v-toolbar-title>
      <Link :href="route('dashboard')">
        <v-btn>
          Admin panel
        </v-btn>
      </Link>
    </v-toolbar-title>
    <v-spacer></v-spacer>

    <v-btn append-icon="mdi-dots-vertical" id="menu-activator">{{ $page.props.auth.user.name }}</v-btn>
  </v-app-bar>

  <v-navigation-drawer
      v-model="drawer"
      location="left"
  >
    <template v-for="item in items">
      <v-list-group
          v-if="item.children"
          :key="item.title + 'group'"
          :append-icon="item.icon"
      >
        <template #activator>
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </template>
        <template v-for="child in item.children" :key="item.title">
          <v-list-item
              v-if="!child.hidden"
              :prepend-icon="item.icon"
          >
            <Link :href="item.link" :method="item.method" :as="item.method !== 'get' ? 'button' : 'a'">
              <v-list-item-title>
                {{ item.title }}
              </v-list-item-title>
            </Link>
          </v-list-item>
        </template>
      </v-list-group>

      <v-list-item
          link
          v-else
          color="primary"
          :prepend-icon="item.icon"
      >
        <Link :href="item.link" :method="item.method" :as="item.method !== 'get' ? 'button' : 'a'">
          <v-list-item-title>
            {{ item.title }}
          </v-list-item-title>
        </Link>
      </v-list-item>
    </template>
  </v-navigation-drawer>

  <v-menu activator="#menu-activator">
    <v-list>
      <v-list-item
          v-for="(item, index) in settingsItems"
          :key="index"
          :value="index"
          :prepend-icon="item.icon"
      >
        <Link :href="item.link" :method="item.method" :as="item.method !== 'get' ? 'button' : 'a'">
          <v-list-item-title>
            {{ item.title }}
          </v-list-item-title>
        </Link>
      </v-list-item>
    </v-list>
  </v-menu>
</template>
<script>
import {Link} from '@inertiajs/vue3'

export default {
  components: {Link},

  data: () => ({
    drawer: false,
    group: null,
    items: [
      {title: 'Dashboard', icon: 'mdi-home', link: route('dashboard'), method: 'get'},
      {title: 'Products', icon: 'mdi-store', link: route('admin.product.view'), method: 'get'},
    ],
    settingsItems: [
      {title: 'Profile', icon: 'mdi-account', link: route('profile.edit'), method: 'get'},
      {title: 'Log out', icon: 'mdi-logout', link: route('logout'), method: 'post'},
    ],
  }),

  watch: {
    group() {
      this.drawer = false
    },
  },
}
</script>
