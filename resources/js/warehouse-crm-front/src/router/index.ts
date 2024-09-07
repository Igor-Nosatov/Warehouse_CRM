import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    component: () => import("@/layouts/MainLayout.vue"),
    children: [
      // Dashboard
      {
        path: "",
        component: () => import("@/modules/dashboard/pages/Dashboard.vue"),
        name: "Dashboard",
      },

      // Products
      {
        path: "products",
        component: () => import("@/modules/products/pages/Product.vue"),
        name: "ProductList",
      },
      {
        path: "add-product",
        component: () => import("@/modules/products/pages/AddProduct.vue"),
        name: "AddProduct",
      },

      // Customer
      {
        path: "customers",
        component: () => import("@/modules/customer/pages/Customer.vue"),
        name: "CustomerList",
      },

      // Vendor
      {
        path: "vendors",
        component: () => import("@/modules/vendors/pages/Vendor.vue"),
        name: "VendorList",
      },

      // Sales Order
      {
        path: "sales-order",
        component: () => import("@/modules/salesOrder/pages/SalesOrder.vue"),
        name: "SalesOrderList",
      },

      // Purchase Order
      {
        path: "purchase-order",
        component: () => import("@/modules/purchaseOrder/pages/PurchaseOrder.vue"),
        name: "PurchaseOrderList",
      },
    ],
  },
  {
    path: "/auth/login",
    component: () => import("@/modules/auth/pages/Login.vue"),
    name: "Login",
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem("tokenWarehouseCrm");
  if (!token && to.path !== "/auth/login") {
    next("/auth/login");
  } else {
    next();
  }
});

export default router;
