<style scoped>

</style>
<template>
    <div>
        <nav-bar></nav-bar>
        <main class="container">
             <div class="login">
                <h1>Registreer</h1>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="voornaam" type="text" class="validate" v-model="input.firstname">
                        <label for="voornaam">Firstname</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="achternaam" type="text" class="validate" v-model="input.secondname">
                        <label for="achternaam">Secondname</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="email" type="email" class="validate" v-model="input.email">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="password" type="password" class="validate" v-model="input.password">
                        <label for="password">Password</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="passwordOpnieuw" type="password" class="validate" v-model="input.password_confirm">
                        <label for="password">Confirm password</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="adress" type="text" class="validate" v-model="input.adress">
                        <label for="adress">Adress</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="postcode" type="text" class="validate" v-model="input.zipcode">
                        <label for="postcode">Zipcode</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="plaats" type="text" class="validate" v-model="input.city">
                        <label for="plaats">City</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light submit" type="submit" name="verstuur" style="float:right;" @click="send">Login
                     <i class="material-icons right"></i>
                </button>
                <p style="margin-top: inherit">
                    <input type="checkbox" id="CheckBox" class="checkbox" v-model="input.conditions" />
                    <label class="voorwaarde" for="CheckBox">I accept the conditions
                    <a style="color:#F4452E;"
                       href="conditions">voorwaarden</a></label>
                </p>
            </div>
        </main>
    </div>
</template>
<script> 
    export default {
        data(){
            return {
                input: {
                    firstname: "",
                    secondname: "",
                    email: "",
                    password: "",
                    password_confirm: "",
                    adress: "",
                    zipcode: "",
                    city: "",
                    conditions: false
                }
			}
		},
		created(){
			//
		},
		methods: {
            send() {
                this.$auth.register(this, this.input, "profile/0");
            }
        }
	}
</script>