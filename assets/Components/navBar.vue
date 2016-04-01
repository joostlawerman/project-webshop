<style scoped>

</style>
<template>
	<nav>
	    <div class="nav-wrapper">
	      	<a v-link="{ path: '/' }" class="brand-logo">PC4U</a>
	      	<a data-activates="mobile-demo" class="button-collapse">
	      		<i class="material-icons">menu</i>
	      	</a>
			<ul class="right hide-on-small-and-down">
				<li v-show="!loggedin">
					<a v-link="{ path: '/login' }">Login</a>
				</li>
				<li v-show="!loggedin">
					<a v-link="{ path: '/register' }">Register</a>
				</li>
				<li v-show="loggedin">
					<a v-link="{ path: '/profile/0' }">Profile</a>
				</li>
				<li v-show="loggedin">
					<a @click="logout">Logout</a>
				</li>
			</ul>
		</div>
	</nav>
</template>
<script>
	export default {
		data(){
			return {
				loggedin: false,
			}
		},
		created(){
			this.loggedin = this.$auth.check();
		},
		methods: {
			logout() {
				this.$auth.logout(this, "/");
			}
		}
	}
</script>