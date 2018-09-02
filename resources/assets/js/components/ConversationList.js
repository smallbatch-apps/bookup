import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import Conversation from "./Conversation";

class ConversationList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            selectedConversationId: false,
            conversations: []
        };
    }

    async componentWillMount() {
        let response = await window.axios(`/api/conversations`);
        this.setState({conversations: response.data});
    }

    selectConversation(selectedConversationId){
        this.setState({selectedConversationId});
    }

    render() {

        const listItems = this.state.conversations.map((conversation) =>
            <li className={`list-group-item ${conversation.id === this.state.selectedConversationId ? 'active' : ''}`}
                onClick={() => this.selectConversation(conversation.id)}
                key={conversation.id}>
                {conversation.title}
            </li>
        );

        return (<div className="row">
            <div className="col-4">
                <ul className="list-group">
                    {listItems}
                </ul>
            </div>
            <div className="col-8">
                <Conversation conversationId={this.state.selectedConversationId} />
            </div>
        </div>);
    }
}
export default ConversationList;