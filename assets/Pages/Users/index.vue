<style scoped>

</style>
<template>
	<div>
		<nav-bar></nav-bar>
		<div>
			
		</div>
	</div>
</template>
<script> 
	export default {
		data(){
			return {
				users: []
			}
		},
		created(){

		},
		methods: {
			get() {
				this.$http.get("/api/users").then((response) => {
    				this.users = response.data;
                    console.log(response);
                    return;
                });
			}
		}
	}
</script>