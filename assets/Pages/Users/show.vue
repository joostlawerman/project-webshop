<style scoped lang="scss">
	input.clean {
		height: auto;
		width: auto;
		border-bottom: none;
		margin: 0;
		&:focus {
			border-bottom: none;
			box-shadow: none;
		}
	}
</style>
<template>
	<div>
		<nav-bar></nav-bar>
		<main class="container">	
			<div class="row">
				<div class="card s12 m6">
					<div class="card-content">
						<span class="card-title">
							Personal details
						</span>
						<ul>
							<li>
								Firstname: <input class="clean" v-model="user.firstname">
							</li>
							<li>
								Secondname: <input class="clean" v-model="user.secondname">
							</li>
						</ul>
					</div>
					<div class="card-action">
						<a @click="update">Update</a>
					</div>
				</div>
				<div class="card s12 m6">
					<div class="card-content">
						<span class="card-title">
							Delivery information
						</span>
						<ul>
							<li>
								Adress: <input class="clean" v-model="user.adress">
							</li>
							<li>
								Zipcode: <input class="clean" v-model="user.zipcode">
							</li>
							<li>
								City: <input class="clean" v-model="user.city">
							</li>
						</ul>
					</div>
					<div class="card-action">
						<a @click="update">Update</a>
					</div>
				</div>
				<div class="card s12 m6">
					<div class="card-content">
						<span class="card-title">
							Account details
						</span>
						<ul>
							<li>
								Email: <input class="clean" v-model="user.email">
							</li>
							<li>
								Password: <input placeholder="enter" class="clean" v-model="user.password">
							</li>
							<li>
								Confirm: <input class="clean" placeholder="enter" v-model="user.password_confirm">
							</li>
						</ul>
					</div>
					<div class="card-action">
						<a @click="update">Update</a>
					</div>
				</div>
			</div>
		</main>
	</div>
</template>
<script> 
	export default {
		data(){
			return {
				user: {

				}
			}
		},
		created(){
			this.get();
		},
		methods: {
			get() {
				let id = this.$route.params.id;

    			this.$http.get('/api/users/'+id).then((response) => {
    				this.user = response.data;
                    console.log(response);
                    return;
                });
			},
			update() {
				let id = this.$route.params.id;

				this.$http.patch('/api/users/'+id, this.user).then((response) => {
					console.log(response);
					this.$snackbar.create("Profile Updated");
                    return;
                }, (errors) => {
                	console.log(errors);
                	
                });	
			}
		}
	}
</script>