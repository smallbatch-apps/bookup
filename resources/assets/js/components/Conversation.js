import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import SendMessage from './SendMessage';

class Conversation extends Component {
    constructor(props) {
        super(props);
        this.state = {
            conversationId: props.conversationId,
            conversation: null,
            messages: []
        };
    }

    componentDidUpdate(prevProps){
        if(prevProps.conversationId != this.props.conversationId) {
            this.getConversation();

            if(this.props.conversationId) {
                if(prevProps.conversationId) {
                    window.Echo.private(`conversations.${prevProps.conversationId}`).stopListening();
                }
                window.Echo.private(`conversations.${this.props.conversationId}`).listen('MessageSent', ({message}) => {
                    this.setState(prevState => ({
                        messages: [...prevState.messages, message]
                    }))
                });
            }
        }
    }

    async componentDidMount(){
        this.getConversation();
    }

    async getConversation(){
        if (!this.props.conversationId) {
            return false;
        }

        const conversation = await window.axios(`/api/conversations/${this.props.conversationId}`);

        this.setState({conversation: conversation.data, messages: conversation.data.messages});
    }

    render() {
        const listItems = this.state.messages.map((message) =>
            <li className={`list-group-item ${window.user.id == message.sender_profile_id ? 'text-right' : ''}`}
                key={message.id}>
                {message.content}
            </li>
        );

        const emptyList = <li className="list-group-item">No messages yet. Say something!</li>;

        const sendForm =  this.props.conversationId ? (<li className="list-group-item">
            <SendMessage
                conversationId={this.props.conversationId}
            />
        </li>) : '';

        return (
            <ul className="list-group">
                { this.state.messages.length ? listItems : emptyList }
                { sendForm }
            </ul>

        );
    }
}

export default Conversation;