/**
 * Created by admin on 20.03.17.
 */

/**
 * Converts a js date string into a custom
 * time format
 */
angular.module('internal').filter('formatTime', function () {
    /**
     * Converts a time string into a custom time format.
     * @param {String} time
     * @param {Boolean} ago
     * @returns {String}
     */
    return function (time, ago = true) {
        return moment(time).fromNow(ago);
    };
});

// Filter to display trusted html code
angular.module('internal').filter('trustHTML', ['$sce', function ($sce) {
    return function (text) {
        return $sce.trustAsHtml(text);
    };
}]);

// maps the object of the objects array to the id given and
// returns the attribute given (may also be a nested attribute)
angular.module('internal').filter('mapById', function () {
    return function (id, objects, attribute) {
        let attrs = attribute.split('.');
        for (let i = 0; i < objects.length; i++) {
            if (Number(objects[i].id) === Number(id)) {
                let value = objects[i][attrs[0]];
                for (let x = 1; x < attrs.length; x++)
                    value = value[attrs[x]];
                return value;
            }
        }
    };
});

angular.module('internal').filter('enumerateParticipants', function () {
    return function (participants, skipId) {
        let result = '';
        for (let i = 0; i < participants.length; i++) {
            if (Number(skipId) !== Number(participants[i].user.id)) {
                if (Number(i) === Number(participants.length - 1))
                    result += participants[i].user.username;
                else
                    result += participants[i].user.username + ', ';
            }
        }
        if (result.endsWith(', '))
            return result.substr(0, result.length - 2);
        return result;
    };
});

