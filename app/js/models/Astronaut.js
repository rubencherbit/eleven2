ElevenApp.Models.Astronaut = Backbone.Model.extend({
    url: ElevenApp.url,

    initialize: function Doc() {

        this.bind("invalid", function (model, error) {
            console.log(error);
        });
    },

    validate: function (attributes) {
        if (attributes.name === '') {
            return "Name not valid";
        }
        if (attributes.birthdate === '') {
            return "birthdate not valid";
        }
        if (attributes.height === '') {
            return "height not valid";
        }
        if (attributes.weight === '') {
            return "weight not valid";
        }
    },

    getId: function () {
        return this.get('id');
    },
    setId: function (value) {
        this.set({
            id: value
        });
    },

    getName: function () {
        return this.get('name');
    },
    setName: function (value) {
        this.set({
            name: value
        }, {
            validate: true
        });
    },
    getBirthdate: function () {
        return this.get('birthdate');
    },
    setBirthdate: function (value) {
        this.set({
            birthdate: value
        }, {
            validate: true
        });
    },
    getWeight: function () {
        return this.get('weight');
    },
    setWeight: function (value) {
        this.set({
            weight: value
        }, {
            validate: true
        });
    },
    getHeight: function () {
        return this.get('height');
    },
    setHeight: function (value) {
        this.set({
            height: value
        }, {
            validate: true
        });
    },
});