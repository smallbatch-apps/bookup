import React, {Component} from 'react';
import ReactDOM from 'react-dom';

import LocationMap from './LocationMap';

class GetLocation extends Component {

    constructor(props) {
        super(props);
        this.state = {
            coords: JSON.parse(this.props.coords)
        };
    }

    updateLocation(event) {
        event.preventDefault();

        //navigator.geolocation.getCurrentPosition(function () {}, function () {}, {});

        navigator.geolocation.getCurrentPosition((property) => {
            let coords = {
                latitude: property.coords.latitude,
                longitude: property.coords.longitude
            };
            this.setState({coords});
        }, function(error){
            console.error(error);
        }, {
            enableHighAccuracy: false,
            maximumAge: Infinity,
            timeout: 10000
        });

    }

    render() {
        const {latitude, longitude} = this.state.coords;

        const locationMap = <LocationMap location={`${latitude}, ${longitude}`} />;

        const noCoords = latitude === 0 && longitude === 0;

        const emptyMap = <div>
            <i className="fa fa-exclamation-triangle"></i> You don't currently have a location set
        </div>;

        return (
            <div>
                <input type="hidden" name="location" defaultValue={`${latitude},${longitude}`} />
                <button onClick={(event) => this.updateLocation(event)} className="btn btn-outline-primary" style={{marginBottom: '20px'}}>
                    <i className="fa fa-globe"></i> {noCoords ? 'Get' : 'Update'} My Location
                </button>

                {noCoords ? emptyMap : locationMap}
            </div>
        )
    }

}

export default GetLocation;