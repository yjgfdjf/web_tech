class Pizza {
    constructor(type, size) {
        this.types = {
            Маргарита: { price: 500, calories: 300 },
            Пепперони: { price: 800, calories: 400 },
            Баварская: { price: 700, calories: 450 },
        };

        this.sizes = {
            Большая: { price: 200, calories: 200 },
            Маленькая: { price: 100, calories: 100 },
        };

        this.toppingsData = {
            "сливочная моцарелла": { price: 50, calories: 20 },
            "сырный борт": {
                Маленькая: { price: 150, calories: 50 },
                Большая: { price: 300, calories: 50 },
            },
            "чедер и пармезан": {
                Маленькая: { price: 150, calories: 50 },
                Большая: { price: 300, calories: 50 },
            },
        };

        if (!this.types[type]) {
            throw new Error("Неизвестный тип пиццы");
        }
        if (!this.sizes[size]) {
            throw new Error("Неизвестный размер пиццы");
        }

        this.type = type;
        this.size = size;
        this.toppings = [];
    }

    addTopping(topping) {
        if (!this.toppingsData[topping]) {
            console.log(`Добавка "${topping}" не найдена`);
            return;
        }
        if (!this.toppings.includes(topping)) {
            this.toppings.push(topping);
        }
    }

    removeTopping(topping) {
        this.toppings = this.toppings.filter(t => t !== topping);
    }

    getToppings() {
        return this.toppings;
    }

    getSize() {
        return this.size;
    }

    getStuffing() {
        return this.type;
    }

    calculatePrice() {
        let price = this.types[this.type].price + this.sizes[this.size].price;
        for (const topping of this.toppings) {
            if (typeof this.toppingsData[topping] === "object" && this.toppingsData[topping][this.size]) {
                price += this.toppingsData[topping][this.size].price;
            } else {
                price += this.toppingsData[topping].price;
            }
        }
        return price;
    }

    calculateCalories() {
        let calories = this.types[this.type].calories + this.sizes[this.size].calories;
        for (const topping of this.toppings) {
            if (typeof this.toppingsData[topping] === "object" && this.toppingsData[topping][this.size]) {
                calories += this.toppingsData[topping][this.size].calories;
            } else {
                calories += this.toppingsData[topping].calories;
            }
        }
        return calories;
    }
}


const myPizza = new Pizza("Пепперони", "Большая");

myPizza.addTopping("сливочная моцарелла");
myPizza.addTopping("сырный борт");

console.log("Размер пиццы:", myPizza.getSize());          
console.log("Тип пиццы:", myPizza.getStuffing());         
console.log("Добавки:", myPizza.getToppings());         
console.log("Цена:", myPizza.calculatePrice());            
console.log("Калории:", myPizza.calculateCalories());     

myPizza.removeTopping("сливочная моцарелла");

console.log("Добавки после удаления:", myPizza.getToppings());
console.log("Новая цена:", myPizza.calculatePrice());
console.log("Новые калории:", myPizza.calculateCalories());
