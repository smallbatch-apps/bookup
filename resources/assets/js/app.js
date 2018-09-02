
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import BookList from './components/BookList';
import Conversation from './components/Conversation';
import ProfileConversation from './components/ProfileConversation';
import ConversationList from './components/ConversationList';
import GetLocation from './components/GetLocation';
import LocationMap from './components/LocationMap';

document.querySelectorAll('BookList').forEach(element => {
    ReactDOM.render(<BookList type={element.getAttribute('type')} />, element);
});

document.querySelectorAll('Conversation').forEach(element => {
    ReactDOM.render(<Conversation profile={element.getAttribute('profile')}  />, element);
});

document.querySelectorAll('ConversationList').forEach(element => {
    ReactDOM.render(<ConversationList  />, element);
});

document.querySelectorAll('ProfileConversation').forEach(element => {
    ReactDOM.render(<ProfileConversation
        conversationId={element.getAttribute('conversationId')}
        profileId={element.getAttribute('profileId')} />,
    element);
});

document.querySelectorAll('GetLocation').forEach(element => {
    ReactDOM.render(<GetLocation coords={element.getAttribute('coords')}  />, element);
});

document.querySelectorAll('LocationMap').forEach(element => {
    ReactDOM.render(<LocationMap location={element.getAttribute('location')} />, element);
});

