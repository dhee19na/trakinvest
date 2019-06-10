<template>

    <div class="card col-md-4 loginBox">
    <article class="card-body">
        <h4 class="card-title text-center mb-4 mt-1">Register</h4>
        <hr>
        <p class="text-success text-center">Please register using below fields</p>

        <div class="alert alert-danger" v-if="has_error && !success">
            <p v-html="errors"></p>
        </div>

        <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input type="email" id="email" class="form-control" placeholder="Email id" v-model="email" required>
            </div> <!-- input-group.// -->
        </div> <!-- form-group// -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                </div>
                <input type="text" id="name" class="form-control" placeholder="User name" v-model="name" required>
            </div> <!-- input-group.// -->
        </div> <!-- form-group// -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-mobile"></i> </span>
                </div>
                <input type="text" id="mobile" class="form-control" placeholder="Mobile number" v-model="mobile" required>
            </div> <!-- input-group.// -->
        </div> <!-- form-group// -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input type="password" id="password" class="form-control" placeholder="Password" v-model="password" required>
            </div> <!-- input-group.// -->
            <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
        </div> <!-- form-group// -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input type="password" id="password_confirmation" placeholder="Confirmation password" class="form-control" v-model="password_confirmation" required>
            </div> <!-- input-group.// -->
        </div> <!-- form-group// -->
        <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div> <!-- form-group// -->
        </form>
    </article>
</div> <!-- card.// -->
    
</template>
<script>
  export default {
    data() {
      return {
        name: 'dhee19na',
        email: 'dheena@gmail.com',
        mobile: '080980980',
        password: 'lkllkjljlj',
        password_confirmation: 'lklkljjlkj',
        has_error: false,
        error: '',
        errors: {},
        success: false
      }
    },

    methods: {
      register() {
        var app = this
        this.$auth.register({
          data: {
            email: app.email,
            name: app.name,
            mobile: app.mobile,
            email: app.email,
            password: app.password,
            password_confirmation: app.password_confirmation
          },
          success: function () {
            app.success = true
            this.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
          },
          error: function (res) { 
              console.log(res.response.data.errors)
            app.has_error = true
            app.error = res.response.data.error
            app.errors = res.response.data.errors || {}
          }
        })
      }
    }
  }
</script>
