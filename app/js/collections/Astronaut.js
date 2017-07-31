ElevenApp.Collections.Astronauts = Backbone.Collection.extend({
    model: ElevenApp.Models.Astronaut,

    url: ElevenApp.url,

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