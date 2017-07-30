ElevenApp.Views.AstronautForm = Backbone.View.extend({
    el: $('#astronaut-form-container'),

    initialize: function () {},

    events: {
        'submit form': 'addAstronaut'
    },
    addAstronaut: function (e) {
        e.preventDefault();
        var obj = {
            name: this.$('.name').val(),
            birthdate: this.$('.birthdate').val(),
            weight: this.$('.weight').val(),
            height: this.$('.height').val()
        };
        var astronaut = new ElevenApp.Collections.Astronauts();
        astronaut.set(obj, {
            error: _.bind(this.error, this)
        });

        // astronaut.create(obj, {
        //     success: function (model, response) {},
        //     error: function (model, response) {
        //         console.log(response);

        //     }
        // });
        $.post("http://eleven2.dev/api/astronauts", obj);
        this.$('input[type="text"]').val('');
        this.$('input[type="number"]').val('');
        this.$('input[type="date"]').val('');

    },
    error: function (model, error) {
        console.log(model, error);
        return this;
    }

});