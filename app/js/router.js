ElevenApp.AstronautsRouter = Backbone.Router.extend({

    initialize: function () {
        this.astronauts = new ElevenApp.Collections.Astronauts();
        this.astronauts.fetch();

        this.astronautFormView = new ElevenApp.Views.AstronautForm({
            collection: this.astronauts
        });
        this.astronautsView = new ElevenApp.Views.AstronautsCollection({
            collection: this.astronauts
        });
        this.astronautsView.render();

        this.route("astronaut/:id", "astronaut", function (id) {
            if (this.astronauts.get(id) !== undefined) {
                this.astronaut = new ElevenApp.Collections.Astronauts({
                    id: id
                });
                this.astronaut.fetch();

                AstronautView = new ElevenApp.Views.Astronaut({
                    model: this.astronaut.get(id)
                });
                AstronautView.render();
            }
        });


    },

});