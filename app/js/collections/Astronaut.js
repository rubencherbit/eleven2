ElevenApp.Collections.Astronauts = Backbone.Collection.extend({
    model: ElevenApp.Models.Astronaut,

    url: "http://eleven2.dev/api/astronauts",

    initialize: function (options) {
        if (options !== undefined) {
            if (options.id !== undefined) {
                this.url += '/' + options.id;
            }
        }

        this.fetch({
            success: this.fetchSuccess,
            error: this.fetchError
        });
    },

    fetchSuccess: function (collection, response) {},

    fetchError: function (collection, response) {
        throw new Error("Books fetch error");
    }
});