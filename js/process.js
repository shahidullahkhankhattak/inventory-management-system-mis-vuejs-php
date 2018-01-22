HomeComponent = Vue.component('home-template',{
    template: "#home-template",
    methods: {
        fixCardsHeight: function(){
            var maxheight = 0;
            $('.card-content').each(function () {
                maxheight = ($(this).height() > maxheight ? $(this).height() : maxheight); 
            });
            var crd_action_height = 0;
            $('.card-action').each(function(){
                crd_action_height = ($(this).height() > crd_action_height ? $(this).height() : crd_action_height); 
            });
            $('.card-content').height(maxheight);
            $('.card-action').height(crd_action_height);
        }
    },
    mounted: function(){
        this.fixCardsHeight();
    }
});





AccountsComponent = Vue.component('accounts-template', {
    template: '#accounts-template'
});





CashComponent = Vue.component('cash-template', {
    template: '#cash-template',
    data: function(){
        return {
            cash: 0,
            inventory: 0,
            recievables: 0
        }
    },
    methods: {
        triggerTabs: function(){
            $('ul.tabs').tabs();
        },
        getCashDetails: function(){
                this.$http.post("./ajax/cash/getcashdetails.php")
                .then(res => {
                    this.cash = res.body.cash;
                    this.inventory = res.body.inventory;
                    this.recievables = res.body.recievables;
                });
        }
    },
    mounted: function(){
        this.triggerTabs();
        this.getCashDetails();
    }
});





CreditSalesComponent = Vue.component('credit-sales-template', {
    template: '#credit-sales-template',
    data: function(){
        return {
            sales: []
        }
    },
    methods: {
        getAllSales: function(id){
            this.$http.post("./ajax/credit_sales/getallsales.php", id)
                      .then(res => {
                          this.sales = res.body;
                      });
        },
        makePayment(id){
            this.$http.post("./ajax/credit_sales/makepayment.php", id)
            .then(res => {
                this.getAllSales();
            });
        }
    },
    mounted: function(){
        if(!this.$route.params.id)
            router.push("/recievables");
        else{
            this.getAllSales(this.$route.params.id);
        }
    }
});




InventoryComponent = Vue.component('inventory-template', {
    template: '#inventory-template',
    data: function(){
        return {
            inventories: []
        }
    },
    methods: {
        getInventory: function(){
            this.$http.post("./ajax/inventory/getinventory.php")
                      .then(res=>{
                        this.inventories = res.body;
                      });
        }
    },
    mounted: function(){
        this.getInventory();
    }
});




RecievablesComponent = Vue.component('recievables-template', {
    template: '#recievables-template',
    data: function(){
        return {
            recievables: []
        }
    },
    methods: {
        getAllRecievables: function(){
            this.$http.post("./ajax/recievable/getallrecievable.php")
                    .then(res => {
                        this.recievables = JSON.parse(res.body);
                    });
        }
    },
    mounted: function(){
        this.getAllRecievables();
    }
});




ContactsComponent = Vue.component('contacts-template', {
    template: '#contacts-template',
    data: function(){
        return {
            contact: {
                name: "",
                phone: "",
                address: ""
            },
            contacts: []
        }
    },
    methods: {
        showModel: function(title, body){
            $(".modal .modal-content h4").html(title);
            $(".modal .modal-content p").html(body);
            $("#msgbox").modal();
            $("#msgbox").modal('open');
        },
        addContact: function(){
            if(this.contact.name == "")
                this.showModel("Wait !", "Please Enter Contact Name");
            else{
                this.$http.post("./ajax/contacts/add_contact.php", JSON.stringify(this.contact))
                .then(res => {
                _result = res.body;
                if(_result == "success"){
                    this.contact.name = ""; this.contact.phone = ""; this.contact.address = "";
                    this.showModel("Done !", "Contact Added Successfully");
                    this.getAllContacts();
                }
                else if(_result == "exist")
                    this.showModel("We're Sorry !", "Contact Already Exist");
                else
                    this.showModel("We're Sorry !", _result);
                });
            }
        },
        getAllContacts: function(){
            this.$http.post("./ajax/contacts/getallcontacts.php")
            .then(res => {
                this.contacts = res.body;
            });
        },
        deleteContact: function(id){
            this.$http.post("./ajax/contacts/delete_contact.php", id)
            .then(res => {
                this.getAllContacts();
            });
        }
    },
    mounted: function(){
        this.getAllContacts();
    }
});
SaleDetailsComponent = Vue.component('sale-details-template', {
    template: '#sale-details-template',
    data: function(){
        return {
            details: []
        }
    },
    mounted: function(){
        if(!this.$route.params.id){
            router.push("/contacts");
        }else{
            var id = this.$route.params.id;
            this.$http.post("./ajax/contacts/get_contact_sale_details.php", id)
            .then(res => {
                this.details = res.body;
            });
        }
    }
});




InvoicesComponent = Vue.component('invoices-template',{
    template: '#invoices-template',
    data: function(){
        return {
            item: {
                name: "",
                quantity: "",
                price: "",
            },
            items: []
        };
    },
    methods:{
        getAllItems(){
            this.$http.post("./ajax/invoices/getallitems.php")
                      .then(res => {
                          this.items = res.body
                      });
        },
        makePurchase: function(){
            if(this.item.name == "" || this.item.quantity == "" || this.item.price == "")
                this.showModel("Wait !", "Please Fill In All The Feilds");
            else
                this.$http.post("./ajax/invoices/additem.php", JSON.stringify(this.item))
                          .then(res => {
                            _result = res.body;
                            if(_result == "success"){
                                this.item.name = ""; this.item.quantity = ""; this.item.price = "";
                                this.showModel("Done !", "Items Added Successfully");
                                this.getAllItems();
                            }
                            else
                                this.showModel("We're Sorry !", "Could'nt Add Item");
                          });
        },
        showModel: function(title, body){
            $(".modal .modal-content h4").html(title);
            $(".modal .modal-content p").html(body);
            $("#msgbox").modal();
            $("#msgbox").modal('open');
        },
        deleteItem: function(id){
            this.$http.post("./ajax/invoices/delete_item.php", id)
            .then(res => {
                this.getAllItems();
            });
        }
    },
    mounted: function(){
        this.getAllItems();
    }
});



SaleOrdersComponent = Vue.component('sale-orders-template',{
    template: '#sale-orders-template',
    data: function(){
        return {
            sale: {
                itemid: "",
                quantity: "",
                price: "",
                contactid: "",
                payment_method: ""
            },
            sales: [],
            items: [],
            contacts: []
        };
    },
    methods:{
        deleteSale: function(id, quantity){
            this.$http.post("./ajax/sales/delete_sale.php", JSON.stringify({id: id, quantity: quantity}))
            .then(res => {
                this.getAllItemsAndContacts();
                this.getAllSales();
            });
        },
        getAllSales: function(){
            this.$http.post("./ajax/sales/getallsales.php")
            .then(res => {
                this.sales = res.body;
            });
        },
        getAllItemsAndContacts: function(){
            this.$http.post("./ajax/sales/getallitemsandcontacts.php")
                      .then(res => {
                          this.items = res.body.items;
                          this.contacts = res.body.contacts;
                          this.items.forEach(item=>{
                              if(parseInt(item.sold) >= parseInt(item.quantity))
                                this.items.splice(this.items.indexOf(item), 1);
                          })
                      });
        },
        makeSale: function(){
            var item_to_be_sold = this.items.filter(item => item.id == this.sale.itemid)[0];
            var max_sell_limit = item_to_be_sold.quantity - item_to_be_sold.sold;
            if(this.sale.itemid == "" || this.sale.quantity == "" || this.sale.price == "" || this.sale.payment_method == "" || this.sale.contactid == "")
                this.showModel("Wait !", "Please Fill In All The Feilds");
            else if(this.sale.quantity > max_sell_limit)
                this.showModel("Wait !", "Quantity exceeded available stock, available stock is "+max_sell_limit);
            else if(parseInt(this.sale.price) < (parseInt(item_to_be_sold.price) + 200)){
                this.showModel("Wait !", "The Minimum Selling Price For Item Is "+(parseInt(item_to_be_sold.price) + 200));
            }
            else 
                this.$http.post("./ajax/sales/addsale.php", JSON.stringify(this.sale))
                          .then(res => {
                            _result = res.body;
                            if(_result == "success"){
                                this.sale.itemid = ""; this.sale.quantity = ""; this.sale.price = ""; this.sale.payment_method = "";
                                this.showModel("Done !", "Items Added Successfully");
                                this.sale.itemid == "";this.sale.quantity="";this.sale.price="";this.sale.payment_method="";this.sale.contactid="";
                                this.getAllItemsAndContacts();
                                this.getAllSales();
                            }
                            else
                                this.showModel("We're Sorry !", "Could'nt Add Item");
                          });
        },
        showModel: function(title, body){
            $(".modal .modal-content h4").html(title);
            $(".modal .modal-content p").html(body);
            $("#msgbox").modal();
            $("#msgbox").modal('open');
        },
        deleteItem: function(id){
            this.$http.post("./ajax/invoices/delete_item.php", id)
            .then(res => {
                this.getAllItems();
            });
        }
    },
    mounted: function(){
        this.getAllItemsAndContacts();
        this.getAllSales();
    }
});






StockComponent = Vue.component('stock-template',{
    template: '#stock-template',
    data: function(){
        return {
            stocks: []
        }
    },
    methods: {
        getAllStock: function(){
            this.$http.post("./ajax/stock/getallstock.php")
            .then(res => {
                this.stocks = res.body;
            });
        }
    },
    mounted: function(){
        this.getAllStock();
    }
});






var router = new VueRouter(
    {
        mode: 'history',
        routes: [
            { path: '', component: HomeComponent},
            { path: '/accounts', component: AccountsComponent},
            { path: '/cash', component: CashComponent},
            { path: '/credit-sales/:id', component: CreditSalesComponent},
            { path: '/inventory', component: InventoryComponent},
            { path: '/recievables', component: RecievablesComponent},
            { path: '/contacts', component: ContactsComponent},
            { path: '/sale-details/:id', component: SaleDetailsComponent},
            { path: '/invoices', component: InvoicesComponent },
            { path: '/sale-orders', component: SaleOrdersComponent},
            { path: '/stock', component: StockComponent}
        ]
    }
)

var app = new Vue({
    el: '#shahbaz-app',
    router: router
});
