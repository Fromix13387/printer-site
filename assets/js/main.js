const app = Vue.createApp({
    data() {
        return {
            data: JSON.parse(localStorage.getItem("basket")) ?? {},

        }
    },
    methods: {
        updateStorage() {
            console.log(JSON.parse(localStorage.getItem("basket")))
            this.data = JSON.parse(localStorage.getItem("basket")) ?? {}
        },
        add(id_product) {
            console.log(id_product)
            if (this.data[id_product] === undefined) this.data = {...this.data, [id_product]: 1}
            else this.data = {...this.data, [id_product]: this.data[id_product]+1}

            localStorage.setItem("basket", JSON.stringify(this.data))
            return this.data
        },
        remove(id_product) {
            if (this.data[id_product] !== undefined) {
                this.data[id_product]--
                if (this.data[id_product] <= 0) delete this.data[id_product]
                localStorage.setItem("basket", JSON.stringify(this.data))
                return true
            }
            return false
        },

         removeAll(id_product) {
            if (this.data[id_product] !== undefined) {
                delete this.data[id_product]
                localStorage.setItem("basket", JSON.stringify(this.data))
                return true
            }
            return false
        },

        clearBasket() {
            localStorage.setItem("basket", JSON.stringify({}))
            this.data = {}
        },
        getProductCount(id_product) {
            if (this.data[id_product] === undefined) return 0
            return this.data[id_product]
        },
        getCountProducts() {
            return Object.keys(this.data).length
        }
    }
})

app.component('basket', {
    data() {
        return {
            data_basket: [],
            check: false
        }
    },
    async mounted() {
        const data = JSON.parse(localStorage.getItem("basket")) ?? {}
        this.data_basket = await fetch("/controllers/get_products.php",{
            headers: {
                "Content-type": 'application/x-www-form-urlencoded'
            },
            method: "POST",
            body: `ids=${Object.keys(data).toString()}`
        }).then(res => res.json())
            .then (res => res.map(el => {
                return {
                    ...el, order_count: data[el.product_id]
                }
            }))
    },
    emits: ['updateStorage'],
    methods: {
        getPriceAll() {
            return this.data_basket.reduce((acc,el) => {
                acc += +el.price * el.order_count
                return acc
            }, 0)
        },
        getPriceProduct(id_product) {
            const res = this.data_basket.filter(el => el.product_id === id_product)[0]
            return (+res.price * res.order_count) ?? 0
        },
        getProductCount(id_product) {
            const res = this.data_basket.filter(el => el.product_id === id_product)[0]
            return res.order_count
        },

        add(id_product) {
            let data = JSON.parse(localStorage.getItem("basket")) ?? {}
            if (data[id_product] === undefined) data = {...data, [id_product]: 1}
            else {
                data = {...data, [id_product]: data[id_product]+1}
                this.data_basket = this.data_basket.map(el => el.product_id === id_product ? {...el, order_count: el.order_count+1} : el)
            }
            localStorage.setItem("basket", JSON.stringify(data))
            return this.data
        },
        remove(id_product) {
            let data = JSON.parse(localStorage.getItem("basket")) ?? {}
            if (data[id_product] !== undefined) {
                data[id_product]--
                this.data_basket = this.data_basket.map(el => el.product_id === id_product ? {...el, order_count: el.order_count-1} : el)
                if (data[id_product] <= 0) {
                    delete data[id_product]
                    this.data_basket = this.data_basket.filter(el => el.product_id !== id_product )
                    localStorage.setItem("basket", JSON.stringify(data))
                    this.$emit('updateStorage')
                }
                else localStorage.setItem("basket", JSON.stringify(data))
                return true
            }
            return false
        },
        async saveOrder() {
            let data = JSON.parse(localStorage.getItem("basket")) ?? {}
            const res = await fetch("/controllers/save_order.php",{
                headers: {
                    "Content-type": 'application/x-www-form-urlencoded'
                },
                method: "POST",
                body: `ids=${Object.keys(data).toString()}&count=${Object.values(data).toString()}`
            })
            this.check=true
            localStorage.removeItem('basket')
            this.$emit('updateStorage')
        }
    },
    template: `
<div v-if="check" class="check">
    <p>ООО “Copy star”</p>
    <p>ИНН 573884628462</p>
    <p>Россия, 111111, г Челябинск, ул Гагарина, 
д. 7</p> <br>
    <p>{{new Date().toLocaleString()}}</p>
    <div class="cards">
    <div v-for="el of data_basket">
    <div>
    <h1>{{el.name_p}}</h1>
    <p>{{getProductCount(el.product_id)}} шт.</p>
</div>
        
        <p>{{getPriceProduct(el.product_id)}}.00$</p>
        
</div>
</div>
    
    <p>Итог: {{getPriceAll()}}.00$</p>
</div>
 <div v-else class="Basket">
        <div class="title">
            <h1>Корзина</h1>
            <p>{{getPriceAll()}}.00$</p>
        </div>
        <div :class="'activeEl'" class="noneEl cards" v-if="data_basket.length !== 0">
            <div class="card" v-for="el of data_basket">
                <img :src="'/assets/images/product/'+el.path" alt="">
                <div>
                <h1>{{getPriceProduct(el.product_id)}}.00$</h1>
                <h3>{{el.name_p}}</h3>
                <div class="desc">
                                   <p>{{el.year}}</p>
                                   <p>{{el.model}}</p>
                               </div>
                <div class="numer">
                <div v-cloak class="numeric">
                        <p class="btn" @click="remove(el.product_id)">-</p>
                        <p>{{getProductCount(el.product_id)}}</p>
                        <p class="btn" @click="add(el.product_id)">+</p>
                    </div>
</div>
</div>
            </div>
        </div> 
        <p v-else>Корзина пуста</p>
        
        <button v-if="data_basket.length !== 0" @click="saveOrder()" href="/pages/check.php">Оформить заказ</button>
        <a v-else href="/index.php#catalog">Перейти в каталог</a>
    </div>`
})

app.mount('#app')