(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0d6347"],{"720f":function(e,t,a){"use strict";a.r(t);var r=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"app-container"},[a("el-card",{directives:[{name:"loading",rawName:"v-loading",value:e.loading,expression:"loading"}]},[a("table-tool",{attrs:{"search-columns":e.searchColumns,"add-able":e.addAble,"export-able":!0},on:{"on-search":e.handleSearch,"on-reset":e.handleReset,"on-add":e.handleAdd}}),a("el-table",{attrs:{data:e.list,fit:"",size:"medium"}},[a("el-table-column",{attrs:{prop:"id",label:"序号",width:"100px"}}),a("el-table-column",{attrs:{prop:"nickname",label:"昵称"}}),a("el-table-column",{attrs:{prop:"username",label:"账号"}}),a("el-table-column",{attrs:{prop:"permissions",label:"角色","show-overflow-tooltip":!0,align:"center"},scopedSlots:e._u([{key:"default",fn:function(t){return e._l(t.row.roles,function(t,r){return a("el-tag",{key:r,staticStyle:{"margin-right":"2px"},attrs:{type:"primary","disable-transitions":""}},[e._v(e._s(t.display_name))])})}}])}),a("el-table-column",{attrs:{prop:"created_at",label:"创建时间"}}),a("el-table-column",{attrs:{align:"center",label:"操作"},scopedSlots:e._u([{key:"default",fn:function(t){return[e.editAble?a("el-button",{attrs:{type:"primary",size:"mini"},nativeOn:{click:function(a){return e.handleEdit(t.row)}}},[e._v("编辑")]):e._e(),e.deleteAble?a("el-popover",{ref:"delete-"+t.row.id,attrs:{placement:"top"}},[a("p",[e._v("确定删除吗？")]),a("el-button",{attrs:{size:"mini"},on:{click:function(a){return e.cancleDelete(t.row.id)}}},[e._v("取消")]),a("el-button",{attrs:{size:"mini",type:"primary"},on:{click:function(a){return e.handleDelete(t.row.id)}}},[e._v("确认")]),a("el-button",{staticStyle:{"margin-left":"10px"},attrs:{slot:"reference",type:"danger",size:"mini"},slot:"reference"},[e._v("删除")])],1):e._e()]}}])})],1),e.total>0?a("app-pagination",{attrs:{total:e.total,page:e.query.page,limit:e.query.limit},on:{"update:page":function(t){return e.$set(e.query,"page",t)},"update:limit":function(t){return e.$set(e.query,"limit",t)},pagination:e.handleGet}}):e._e()],1),a("el-dialog",{attrs:{visible:e.dialogVisible,title:e.dialogTitle+"管理员","close-on-click-modal":!1,"close-on-press-escape":!1},on:{"update:visible":function(t){e.dialogVisible=t},closed:e.handleClosed}},[a("el-form",{ref:"dataForm",attrs:{rules:e.formRules,model:e.formData,"label-width":"100px","label-position":"right"}},[a("el-form-item",{attrs:{label:"昵称:",prop:"nickname"}},[a("el-col",{attrs:{span:20}},[a("el-input",{attrs:{autocomplete:"off",placeholder:"请输入昵称"},model:{value:e.formData.nickname,callback:function(t){e.$set(e.formData,"nickname",t)},expression:"formData.nickname"}})],1)],1),a("el-form-item",{attrs:{label:"账号:",prop:"username"}},[a("el-col",{attrs:{span:20}},[a("el-input",{attrs:{autocomplete:"off",placeholder:"请输入账号",disabled:e.isEdit},model:{value:e.formData.username,callback:function(t){e.$set(e.formData,"username",t)},expression:"formData.username"}})],1)],1),e.isEdit?a("el-form-item",{attrs:{label:"原密码:",prop:"old_password"}},[a("el-col",{attrs:{span:20}},[a("el-input",{attrs:{autocomplete:"off",placeholder:"请输入密码","show-password":""},model:{value:e.formData.old_password,callback:function(t){e.$set(e.formData,"old_password",t)},expression:"formData.old_password"}})],1)],1):e._e(),a("el-form-item",{attrs:{label:"密码:",prop:"password"}},[a("el-col",{attrs:{span:20}},[a("el-input",{attrs:{autocomplete:"off",placeholder:"请输入密码","show-password":""},model:{value:e.formData.password,callback:function(t){e.$set(e.formData,"password",t)},expression:"formData.password"}})],1)],1),a("el-form-item",{attrs:{label:"确认密码:",prop:"password_confirmation"}},[a("el-col",{attrs:{span:20}},[a("el-input",{attrs:{autocomplete:"off",placeholder:"请确认密码","show-password":""},model:{value:e.formData.password_confirmation,callback:function(t){e.$set(e.formData,"password_confirmation",t)},expression:"formData.password_confirmation"}})],1)],1),a("el-form-item",{attrs:{label:"角色:",prop:"roles"}},[a("el-col",{attrs:{span:20}},[a("el-checkbox-group",{model:{value:e.formData.roles,callback:function(t){e.$set(e.formData,"roles",t)},expression:"formData.roles"}},e._l(e.allRoles,function(t,r){return a("el-checkbox",{key:r,attrs:{label:t.id}},[e._v(e._s(t.display_name))])}),1)],1)],1)],1),a("div",{attrs:{slot:"footer"},slot:"footer"},[a("el-button",{nativeOn:{click:function(t){return e.handleCancle(t)}}},[e._v("取 消")]),e.isEdit?a("el-button",{attrs:{type:"primary",loading:e.storeLoading},on:{click:e.handleUpdate}},[e._v("确 定")]):a("el-button",{attrs:{type:"primary",loading:e.storeLoading},on:{click:e.handleStore}},[e._v("确 定")])],1)],1)],1)},o=[],l=a("0c32"),n=(a("4b77"),a("1b55"),a("8b39")),s=a.n(n),i=(a("6922"),a("5d26")),c=a("e21d"),d=a("08cd"),m=a("ec4b"),p=a("6a3c"),u=a("6e1a"),f=a("47ad"),b=a("ffc6"),h=a("24b2"),g=a("aef3"),w=a("e3e1"),_=a("0dd3"),k=a("c595"),v=a("292c"),D=Object(d["a"])("admin"),y=D.mapState,x=D.mapGetters,q=D.mapActions,A={name:"Admin",data:function(){return{query:{page:1,limit:20},searchColumns:[{title:"昵称",name:"nickname"}],formRules:{username:[{required:!0,message:"请填写账号",trigger:"blur"}],nickname:[{required:!0,message:"请填写昵称",trigger:"blur"}],password:[{required:!0,message:"请填写密码",trigger:"blur"}],password_confirmation:[{required:!0,message:"请确认密码",trigger:"blur"}],old_password:[{required:!0,message:"请填写原密码",trigger:"blur"}],roles:[{required:!0,message:"请选择角色",trigger:"blur"}]},formData:{id:0,nickname:"",username:"",old_password:"",password:"",password_confirmation:"",roles:[]},isEdit:!1,allRoles:[]}},beforeRouteEnter:function(){var e=Object(i["a"])(regeneratorRuntime.mark(function e(t,a,r){var o;return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,c["a"].dispatch("admin/get");case 3:return e.next=5,c["a"].dispatch("role/all");case 5:o=e.sent,r(function(e){e.setRoles(o.data)}),e.next=12;break;case 9:e.prev=9,e.t0=e["catch"](0),s.a.error(e.t0.response.data.message);case 12:case"end":return e.stop()}},e,null,[[0,9]])}));function t(t,a,r){return e.apply(this,arguments)}return t}(),components:{TableTool:m["a"],AppPagination:p["a"]},mixins:[u["a"],f["a"],b["a"],h["a"],g["a"],_["a"],_["a"],w["a"],k["a"]],methods:Object(l["a"])({},q(["get","store","delete","update"]),{setRoles:function(e){this.allRoles=e},handleAdd:function(e){this.isEdit=!1,this.dialogVisible=e,this.dialogTitle="新增",this.formData.id=0,this.formData.nickname="",this.formData.username="",this.formData.roles=[]},handleEdit:function(e){this.isEdit=!0,this.formData.id=e.id,this.formData.nickname=e.nickname,this.formData.username=e.username,this.formData.roles=e.roles.map(function(e){return e.id}),this.dialogTitle="编辑",this.dialogVisible=!0}}),computed:Object(l["a"])({},y({list:function(e){return e.list}}),x(["total"]),{addAble:function(){return Object(v["a"])("admins-create")},editAble:function(){return Object(v["a"])("admins-edit")},deleteAble:function(){return Object(v["a"])("admins-destroy")}}),mounted:function(){this.query={page:1,limit:20}}},R=A,E=a("157b"),O=Object(E["a"])(R,r,o,!1,null,"2f6150ab",null);t["default"]=O.exports}}]);
//# sourceMappingURL=chunk-2d0d6347.f63e9659.js.map