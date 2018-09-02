import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import Conversation from './Conversation';
import CreateConversation from './CreateConversation';

class ProfileConversation extends Component {
    constructor(props) {
        super(props);
        this.state = {
            conversationId: this.props.conversationId
        };

        this.createConversation.bind(this);
    }

    async createConversation() {
        const conversation = await window.axios.post('/api/conversations', {
            profileId: this.props.profileId
        });

        this.setState({conversationId: conversation.data.id});
    }

    render(){
        if (!this.state.conversationId) {
            return  <CreateConversation profileId={this.props.profileId} create={() => this.createConversation()} />;
        }

        return  <Conversation conversationId={this.state.conversationId} />;
    }
}

export default ProfileConversation;