var ElevenApp = {

    Views: {},
    Models: {},
    Collections: {},
    Router: {},
    url: "http://eleven2.dev/api/astronauts"
}

$(document).ready(function () {
    router = new ElevenApp.AstronautsRouter();
    astronauts = new ElevenApp.Collections.Astronauts();
    astronauts.fetch();
    AstronautsCollectionView = new ElevenApp.Views.AstronautsCollection({
        collection: astronauts
    })
    AstronautsCollectionView.render()
    astronautFormView = new ElevenApp.Views.AstronautForm({
        collection: astronauts
    });
    Backbone.history.start();
});