class Pizza {
    constructor(type, size) {
        this.types = {
            "Маргарита": { price: 500, calories: 300 },
            "Пепперони": { price: 800, calories: 400 },
            "Баварская": { price: 700, calories: 450 }
        };

        this.toppings = {
            "Сливочная моцарелла": { price: 99, calories: 20 },
            "Сырный бортик": { price: 189, calories: 50 },
            "Чеддер и пармезан": { price: 99, calories: 50 }
        };

        this.size = size;
        this.type = type;
        this.selectedToppings = [];

        const base = this.types[type];
        this.basePrice = base.price;
        this.baseCalories = base.calories;

        if (size === "Большая") {
            this.basePrice += 200;
            this.baseCalories += 200;
        } else {
            this.basePrice += 100;
            this.baseCalories += 100;
        }
    }

    addTopping(name) {
        if (!this.selectedToppings.includes(name)) {
            this.selectedToppings.push(name);
        }
    }

    removeTopping(name) {
        this.selectedToppings = this.selectedToppings.filter(t => t !== name);
    }

    calculatePrice() {
        return this.basePrice + this.selectedToppings.reduce((sum, t) => sum + this.toppings[t].price, 0);
    }

    calculateCalories() {
        return this.baseCalories + this.selectedToppings.reduce((sum, t) => sum + this.toppings[t].calories, 0);
    }
}

let pizza = new Pizza("Маргарита", "Маленькая");

function selectPizza(type) {
    pizza = new Pizza(type, pizza.size);
    updateDisplay();
    updatePizzaButtons();
}

function selectSize(size) {
    pizza = new Pizza(pizza.type, size);
    updateDisplay();
    updateSizeRadios();
}

function toggleTopping(checkbox) {
    if (checkbox.checked) {
        pizza.addTopping(checkbox.value);
    } else {
        pizza.removeTopping(checkbox.value);
    }
    updateDisplay();
    updateToppingCheckboxes();
}

function updateDisplay() {
    document.getElementById("add-to-cart").textContent =
        `Добавить в корзину за ${pizza.calculatePrice()}₽ (${pizza.calculateCalories()} кКал)`;
}

function updatePizzaButtons() {
    const buttons = document.querySelectorAll('.pizza-types button');
    buttons.forEach(btn => {
        if (btn.textContent.trim() === pizza.type) {
            btn.classList.add('selected');
        } else {
            btn.classList.remove('selected');
        }
    });
}

function updateToppingCheckboxes() {
    const checkboxes = document.querySelectorAll('.toppings input[type="checkbox"]');
    checkboxes.forEach(chk => {
        chk.checked = pizza.selectedToppings.includes(chk.value);
    });
}

function updateSizeRadios() {
    const radios = document.querySelectorAll('.pizza-size input[type="radio"]');
    radios.forEach(radio => {
      radio.checked = (radio.value === pizza.size);
      if (radio.checked) {
        radio.parentElement.classList.add('selected');
      } else {
        radio.parentElement.classList.remove('selected');
      }
    });
  }

  
window.onload = () => {
    updatePizzaButtons();
    updateSizeRadios();
    updateToppingCheckboxes();
    updateDisplay();
};
