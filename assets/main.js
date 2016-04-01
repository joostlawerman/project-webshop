let Vue = require("vue");
let VueRouter = require("vue-router");
let VueResource = require("vue-resource");

let page = {};
let Snackbar = require("snackbarlightjs");

Vue.use(VueRouter);
Vue.use(VueResource);
Vue.use(Snackbar);


// Router
let router = new VueRouter({
	//history: true,
	saveScrollPosition: true
});


const LOGIN_URL = "/api/login";
const SIGNUP_URL = "/api/users";
const LOGOUT_URL = "/api/logout"

Auth = {
	install() {
		Vue.prototype.$auth = new Authenticate();
	}
}

class Authenticate {
	constructor() {
		this.authenticated = this.check();
	}
	login(context, input, redirect = false) {
		
		context.$http.post(LOGIN_URL, input).then((response) => {
			this.setToken(response.data.token);

			this.authenticated = true;

			if (redirect !== false) {
				context.$router.go(redirect);
			}
		}, (errors) => {
			this.snackbarErrors(context, errors);
		});
	}
	register(context, input, redirect = false, login = true) {
		context.$http.post(SIGNUP_URL, input).then((response) => {
			if (login) {
				this.setToken(response.data.token);

				this.authenticated = true;
			}
			if (redirect !== false) {
				context.$router.go(redirect);
			}
		}, (errors) => {
			this.snackbarErrors(context, errors);
		});
	}
	logout(context, redirect = false) {
		context.$http.get(LOGOUT_URL).then((response) => {
			this.removeToken();
			this.authenticated = false;

			if (redirect !== false) {
				context.$router.go(redirect);
			}
		});
	}
	check() {
		let token = this.getToken();
		if (typeof(token) != "undefined" && token != null) {
			return true;
		}
		return false;
	}
	snackbarErrors(context, errors) {
		let fields = errors.data.errors;
		for (let field in fields) {
			let errorsField = fields[field];

			for (let i = errorsField.length - 1; i >= 0; i--) {
				context.$snackbar.create(errorsField[i]);
			}
		}
	}
	getToken() {
		return localStorage.getItem("token")
	}
	setToken(token) {
		localStorage.setItem("token", token);
	}
	removeToken() {
		localStorage.removeItem("token")
	}
}

Vue.http.interceptors.push({
    request: function(request) {

        var headers = request.headers;

        if (!headers.hasOwnProperty('Authorization')) {
            headers['Authorization'] = localStorage.getItem("token");
        }

        return request;
    }
});

Vue.use(Auth);
Vue.http.headers.common["Authorization"] = "Bearer " + localStorage.getItem("token");

page.landing = require("./Pages/landing.vue");
page.productsIndex = require("./Pages/Products/index.vue");
page.productsShow = require("./Pages/Products/show.vue");
page.login = require("./Pages/Auth/login.vue");
page.register = require("./Pages/Auth/register.vue");
page.usersShow = require("./Pages/Users/show.vue");
page.notFound = require("./Pages/notFound.vue");

navBar = require("./Components/navBar.vue");
product = require("./Components/productCard.vue");

router.map({
	"":{
		component: page.productsIndex,
		name: "home",
	},
	"login":{
		component: page.login,
		name: "login",
	},
	"register":{
		component: page.register,
		name: "register",
	},
	"profile/:id":{
		component: page.usersShow,
		name: "profile",
	},
	"*":{
		component: page.notFound,
		name: "notFound",
	}
});


Vue.config.debug = true;

Vue.component('nav-bar', navBar);
Vue.component('product', product);

let App = Vue.extend({});

router.start(App, "#app");