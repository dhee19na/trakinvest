<template>

<div class="card col-md-4 loginBox">
    <article class="card-body">
        <h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
        <hr>
        <p class="text-success text-center">Please login using Email id and Password</p>
        <div class="alert alert-danger" v-if="has_error && !success">
            <p v-html="errors"></p>
        </div>

        <form autocomplete="off" @submit.prevent="login" method="post">
        <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
        </div> <!-- input-group.// -->
        </div> <!-- form-group// -->
        <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input type="password" id="password" class="form-control" v-model="password" required>
        </div> <!-- input-group.// -->
        </div> <!-- form-group// -->
        <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Login  </button>
        </div> <!-- form-group// -->
        </form>
    </article>
</div> <!-- card.// -->
</template>

<script>
  export default {
    data() {
      return {
        email: null,
        password: null,
        has_error: false
      }
    },

    mounted() {
      //
    },

    methods: {
      login() {
        // get the redirect object
        var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          params: {
            email: app.email,
            password: app.password
          },
          success: function() {
            // handle redirection
            const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 2 ? 'admin.dashboard' : 'dashboard'

            this.$router.push({name: redirectTo})
          },
          error: function() {
            app.has_error = true;
            app.errors = 'Invalid Email id or Password';
          },
          rememberMe: true,
          fetchUser: true
        })
      }
    }
  }
</script>