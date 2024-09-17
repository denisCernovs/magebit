'use strict';
define([
    'ko',
    'uiElement'
], function (ko, Element) {
    return Element.extend({
        defaults: {
            template: 'Magento_Catalog/input-counter',
            maxQty: 1,
            minQty: 1
        },
        initObservable: function () {
            this._super()
                .observe(['qty', 'maxQty']);

            this.updateStyles();
            this.qty.subscribe(this.updateStyles.bind(this));

            // Subscribe to changes in qty and call handleUserInput
            this.qty.subscribe(function(newValue) {
                let value = parseInt(newValue)
                !isNaN(value) ?
                    this.handleUserInput(parseInt(newValue)) :
                    this.handleUserInput(this.minQty)
            }, this);

            return this;
        },
        getDataValidator: function() {
            return JSON.stringify(this.dataValidate);
        },
        decreaseQty: function() {
            let qty = this.qty();

            if (qty > this.minQty) {
                this.qty(qty - 1);
            } else {
                this.qty(this.minQty);
            }
            this.updateStyles();
        },
        increaseQty: function() {
            let qty = this.qty();
            let maxQty = this.maxQty();

            if (qty < maxQty) {
                this.qty(qty + 1);
            } else {
                this.qty(maxQty);
            }
            this.updateStyles();
        },
        handleUserInput: function(newValue) {

            let qtyMax = this.maxQty();
            let qtyMin = this.minQty;

            if (newValue > qtyMax) {
                this.qty(qtyMax);
            } else if (newValue < qtyMin) {
                this.qty(qtyMin);
            } else {
                this.qty(newValue);
            }
        },
        updateStyles: function() {
            let qty = this.qty();
            let qtyMax = this.maxQty();
            let qtyMin = this.minQty;

            // Get the elements
            let increaseButton = document.querySelector('.qty-counter__icon--increase svg');
            let decreaseButton = document.querySelector('.qty-counter__icon--decrease svg');

            // Check if elements exist before trying to change styles
            if (increaseButton) {
                qty === qtyMax ?
                    increaseButton.setAttribute("fill", "#333") :
                    increaseButton.setAttribute("fill", "#FF5501");
            }

            if (decreaseButton) {
                qty > qtyMin ?
                    decreaseButton.setAttribute("fill", "#FF5501") :
                    decreaseButton.setAttribute("fill", "#333");
            }
        }
    });
});
