<template>
  <v-card class="navbar_block">
    <v-row no-gutters class="pb-3 ">
      <v-col cols="2" class="d-flex flex-row justify-start align-center">
        <v-toolbar-title class="ml-3 pt-2">
          <i class="las la-binoculars"></i>
          <span class="toolbar_title">StockSavvy</span>
        </v-toolbar-title>
      </v-col>
      <v-col cols="8">
        <div class="d-flex justify-center pt-5">
          <RouterLink to="/" class="link-style-disabled">
            <v-btn rounded class="nav_btn">
              <i class="las la-tachometer-alt"></i>
              Dashboard
            </v-btn>
          </RouterLink>
          <RouterLink to="/products" class="link-style-disabled">
            <v-btn rounded class="nav_btn">
              <i class="las la-warehouse"></i>
              Products
            </v-btn>
          </RouterLink>
          <RouterLink to="/sales-order" class="link-style-disabled">
            <v-btn rounded class="nav_btn">
              <i class="las la-shopping-cart"></i>
              Sales
            </v-btn>
          </RouterLink>
          <RouterLink to="/purchase-order" class="link-style-disabled">
            <v-btn rounded class="nav_btn">
              <i class="las la-clipboard"></i>
              Purchase
            </v-btn>
          </RouterLink>
          <RouterLink to="/customers" class="link-style-disabled">
            <v-btn rounded class="nav_btn">
              <i class="las la-chart-line"></i>
              Customers
            </v-btn>
          </RouterLink>
          <RouterLink to="/vendors" class="link-style-disabled">
            <v-btn rounded class="nav_btn">
              <i class="las la-file-alt"></i>
              Vendors
            </v-btn>
          </RouterLink>
        </div>
      </v-col>
      <v-col cols="2">
        <div class="d-flex justify-end pt-4 pr-4">
          <v-btn icon class="btn_icon"><i class="las la-cog"></i></v-btn>
          <v-btn icon class="btn_icon"><i class="las la-bell"></i></v-btn>
          <div class="circle_notify"></div>
          <v-btn icon class="btn_icon"><i class="las la-user-alt"></i></v-btn>
        </div>
      </v-col>
    </v-row>
  </v-card>
</template>

<style scoped>
.navbar_block {
  background-color: #111e22 !important;
  border-bottom: 1p#000 !important;
  min-width: 1200px;
}
.link-style-disabled{
  text-decoration: none;
}
.las{
  font-size: 25px;
}
.la-binoculars{
  color:#39dB7d;
  font-size: 50px !important;
  margin:5px;
}
.toolbar_title {
  width: 300px !important;
  font: 24px/1 "Nunito", sans-serif;
  color: #fff !important;
  font-weight: 700;
  letter-spacing: 3px;
  position: relative;
  bottom: 6px;
}
.nav_btn,
.btn_icon {
  border: 1px #70888f solid;
  margin: 5px 6px;
  font: 16px/1 "Nunito", sans-serif;
  background-color: #111e22 !important;
  color: #a2b2bb !important;
  font-weight:400;
}
.nav_btn {
  width: 145px !important;
 height: 45px !important;
  text-transform: capitalize;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}
.nav_btn:hover,
.btn_icon:hover {
  color: #fff !important;
  background-color: #253d44 !important;
  border: 1px #253d44 solid;
}
.nav_btn:hover i {
  color: #39dB7d !important;
}
.dropdown_list {
  border-radius: 10px !important;
  color: #fff;
  background-color: #28424e !important;
  position: relative;
  top: 5px;
  font: 14px/1 "Nunito", sans-serif;
}
.la-caret-down {
  font-size: 16px !important;
}
.circle_notify{
  height: 8px;
  width: 8px;
  background-color: #39dB7d;
  position: relative;
  top: 20px;
  right: 29px;
  border-radius: 100%;
}
</style>
