import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import { Map, Marker, Popup, TileLayer } from 'react-leaflet'

class LocationMap extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        const [lat, long] = this.props.location.split(',');

        console.log(lat, long);

        return (<Map center={[+lat, +long]} zoom={14}>
            <TileLayer
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                attribution="&copy; <a href=&quot;http://osm.org/copyright&quot;>OpenStreetMap</a> contributors"
            />

            <Marker position={[+lat, +long]}></Marker>
        </Map>);
    }

}

export default LocationMap;