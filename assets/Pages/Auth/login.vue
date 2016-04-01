<style scoped>

</style>
<template>
	<div>
		<nav-bar></nav-bar>
		<main class="container">	
			<div class="login">
				<h1>Login</h1>
				<div class="row">
		            <div class="input-field col s12">
		                <input id="userID" 
		                  	type="text" 
		                  	class="validate"
		                    name="login"
		                    v-model="input.email">

		                <label for="userID">
		                	Email
		                </label>
		                <i class="large perm_identity"></i>
		            </div>
		            <div class="input-field col s12">
		                <input id="wachtwoord" 
		                  	type="password" 
		                  	class="validate"
		                    name="password"
		                    v-model="input.password"
		                    @enter="send">

		                <label for="wachtwoord">
		                	Password
		                </label>
		            </div>
		        </div>
		        <div>
		            <button class="btn waves-effect waves-light"
						type="submit"  
						style="float:right;"
						@click="send">

		                Login
		              	<i class="material-icons right"></i>
		            </button>
		            <p style="margin-top: inherit;">
				    	<input type="checkbox" id="CheckBox"/>
				        
				        <label for="CheckBox">
				        	Remember me
				        </label>
		            </p>
		        </div>		
				<div class="login-help">
					<p>
						Forgot your password? 
						<a v-link="{ path:'/password' }">
							klick here.
						</a>
					</p>
					<p>
						No account? 
						<a v-link="{ path:'/register' }">
							Register!
						</a>
					</p>
				</div>
			</div>
		</main>
	</div>
</template>
<script>
	export default {
		data(){
			return {
				input: {
					email: "",
					password: ""
				}
			}
		},
		created(){
			//
		},
		methods: {
			send() {
            	this.$auth.login(this, this.input, "profile/0");
            }
		}
	}
</script>