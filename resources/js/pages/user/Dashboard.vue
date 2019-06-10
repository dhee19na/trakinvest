<template>
    <div class="container">
        <div class="table-wrapper">
            <div class="alert alert-danger" v-if="has_error && !success">
                <p v-html="errors"></p>
            </div>
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>User <b>Details</b></h2></div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-info add-new" v-on:click="showAdd=1"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control search" placeholder="Search">
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-responsive-sm">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-if="users.length > 0">
                        <tr v-for="(value, key) in users">
                            <td>{{value.name}}</td>
                            <td>{{value.mobile}}</td>
                            <td>{{value.email}}</td>
                            <td>********</td>
                            <td style="display:none">{{value.id}}</td>
                            <td>
                                <a class="add" v-on:click="add()" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                                <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            </td>
                        </tr>
                    

                     <tr v-show="showAdd">
                        <td><input type="text" class="form-control data" placeholder="name" name="name" id="name"></td>
                        <td><input type="text" class="form-control data" placeholder="mobile" name="mobile" id="mobile"></td>
                        <td><input type="text" class="form-control data" placeholder="email" name="email" id="email"></td>
                        <td><input type="text" class="form-control data" placeholder="password" name="password" id="password"></td>
                        <td>
                        <a title="" v-on:click="add" data-toggle="tooltip" class="add" style="display: inline;" data-original-title="Add"><i class="material-icons"></i></a> 
                        <a title="" data-toggle="tooltip" class="edit" style="display: none;" data-original-title="Edit"><i class="material-icons"></i></a> 
                        </td>
                    </tr>    
                    </template>

                    <template v-else>
                        <tr><td colspan="6" >Sorry no user found</td></tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>     
</template>

<script>

  export default {
    data() { 
      return {
        showAdd:false,
        has_error: false,
        users:[],
        errors:'',
      }
    },
    beforeMount(){
        this.fetchData()
    },
    methods: {
      fetchData() {
        var app = this
        this.$auth.fetch({
        success: function (res) {
            app.users = res.data.data;
        },
        error: function (res) {
            console.log(res.response.data.errors)
            app.has_error = true
            app.error = res.response.data.error
            app.errors = res.response.data.errors || {}
          }
        })
      },
      add(e) {
        var self = this;
        var i = 0;
        $('.data').each(function(){
			if(!$(this).val()){
                i=0;
                $(this).addClass("error");
			} else{
                i = 1;
            }
        });
        
        if(i==1) {    
            $.ajax({
                url:'/api/auth/register',
                method: 'POST',
                dataType:"JSON",
                data:{
                    name: $('.data:eq(0)').val(),
                    mobile: $('.data:eq(1)').val(),
                    email: $('.data:eq(2)').val(),
                    password: $('.data:eq(3)').val(),
                    password_confirmation: $('.data:eq(3)').val(),
                },
                beforeSend: function (data) {
                    $("#fadpage").show();
                },
                success: function (data) {
                    self.showAdd = false;
                    $(this).removeClass("error");
                    self.fetchData();
                    self.has_error = false;
                },
                error: function (res) {
                    self.has_error = true
                    self.errors = res.responseJSON.errors || {}
                }
            });
        }
      },

      edit: function(e) {
        console.log('Editing element');
        
        
      },
    },

    mounted: function() {
        var self = this
        $('body').on('click','.edit',function(){
            var j = 1;
            $(this).parents("tr").find("td:not(:last-child)").each(function(){
                if(j==4) {
                    $(this).html('<input type="password" class="form-control data" value="">');
                } else if(j==5) {
                    $(this).html('<input type="text" class="form-control data" value="'+$(this).text()+'">');
                } else {
                    $(this).html('<input type="text" class="form-control data" value="'+$(this).text()+'">');
                }
                j++;
            });		
            $(this).parents("tr").find(".add, .edit").toggle();
            $(this).parents("tr").find(".add").toggleClass('add update');
            $(".add-new").attr("disabled", "disabled");
        });

        $('body').on('click','.update', function() {
            var cel = $(this);
            var j = 0;
            $(this).closest('tr').find('.data').each(function(){
                if(!$(this).val()){
                    $(this).addClass("error");
                } else {
                    j++;
                }
            });
        
            if(j==$(this).closest('tr').find('.data').length) {    
                $.ajax({
                    url:'/api/auth/updateData',
                    method: 'POST',
                    dataType:"JSON",
                    data:{
                        name: $('.data:eq(0)').val(),
                        mobile: $('.data:eq(1)').val(),
                        email: $('.data:eq(2)').val(),
                        password: $('.data:eq(3)').val(),
                        password_confirmation: $('.data:eq(3)').val(),
                        id: $('.data:eq(4)').val(),
                    },
                    beforeSend: function (data) {
                        $("#fadpage").show();
                    },
                    success: function (data) {
                        var k = 1;
                        cel.parents("tr").find('input').each(function(){
                            if(k<5) {
                                if(k==4) {
                                    $(this).parent("td").html('********');
                                } else {
                                    $(this).parent("td").html($(this).val());
                                }
                            }
                            k++;
                        });			
                        cel.parents("tr").find(".update, .edit").toggle();
                        $(".add-new").removeAttr("disabled");
                    },
                    error: function (res) {
                        self.has_error = true
                        self.errors = res.responseJSON.errors || {}
                    }
                });
            }
        });

        $('body').on('keypress','.search',function() {
            if($(this).val()!='') {
                $('td:contains("'+$(this).val()+'")').parent().toggle();
            } else {
                
            }
        });
    },

    components: {
      //
    }
}

$('[data-toggle="tooltip"]').tooltip();
</script>