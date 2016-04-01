<style scoped>

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
								Firstname: {{user.firstname}}
							</li>
							<li>
								Secondname: {{user.secondname}}
							</li>
						</ul>
					</div>
				</div>
				<div class="card s12 m6">
					<div class="card-content">
						<span class="card-title">
							Delivery information
						</span>
						<ul>
							<li>
								Adress: {{user.adress}}
							</li>
							<li>
								Zipcode: {{user.zipcode}}
							</li>
							<li>
								City: {{user.city}}
							</li>
						</ul>
					</div>
				</div>
				<div class="card s12 m6">
					<div class="card-content">
						<span class="card-title">
							Account details
						</span>
						<ul>
							<li>
								Email: {{user.email}}
							</li>
							<li>
								Password: <a>Change</a>
							</li>
						</ul>
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
				let __self = this,
					id = this.$route.params.id;

    			this.$http.get('/api/users/'+id).then(function(response){
    				__self.user = response.data;
                    console.log(response);
                    return;
                });
			}
		}
	}
</script>