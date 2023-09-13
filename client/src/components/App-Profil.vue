<template>
  <div class="profile">
    <div v-if="user">
      <div class="profile-banner">
        <img :src="user.avatar" alt="User Banner" />
      </div>
      <h2>{{ user.name }}</h2>
      <button @click="editProfile">Edit Profile</button>
      <button @click="deleteProfile">Delete Profile</button>
    </div>
    <div v-else>
      Loading...
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: null,
      userId: localStorage.getItem('id'),  // Fetching userId from localStorage
      apiBaseUrl: "http://localhost:8000/api"
    };
  },
  created() {
    this.fetchUser();
  },
  methods: {
    async fetchUser() {
  try {
    const response = await fetch(`${this.apiBaseUrl}/users/${this.userId}`);
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    const responseData = await response.json();
    this.user = responseData.user; // <-- This is the change
  } catch (error) {
    console.error('Error fetching user:', error);
  }
}
,
    editProfile() {
      this.$router.push({ name: 'edit-profile', params: { userId: this.userId } });
    },
    async deleteProfile() {
      try {
        const response = await fetch(`${this.apiBaseUrl}/users/${this.userId}`, {
          method: 'DELETE',
        });
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        localStorage.removeItem('id');
        this.$router.push({ name: 'login' });  // Redirect to login after deletion
      } catch (error) {
        console.error('Error deleting profile:', error);
      }
    }
  }
};
</script>

  <style>
  /* Add your styles here */
  </style>
  