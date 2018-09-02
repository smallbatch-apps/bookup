import React, {Component} from 'react';
import ReactDOM from 'react-dom';

class SendMessage extends Component {
    constructor(props){
        super(props);
        this.state = {
            message: '',
            sending: false
        }
    }

    async handleSubmit(event){
        event.preventDefault();
        const conversation = await window.axios.post(`/api/conversations/${this.props.conversationId}/messages`, this.state);

        this.setState({message: '', sending: false});
    }


    render(){

        const buttonIcon = this.state.sending ? 'fa-spinner' : 'fa-comment-alt';
        return (<form onSubmit={this.handleSubmit.bind(this)}>
            <div className="input-group">
            <input type="text" className="form-control" value={this.state.message}
                   onChange={event => this.setState({message: event.target.value})}  />
            <div className="input-group-append">
                <button className="btn btn-outline-secondary" type="submit">
                    <i className={`fa fa-fw ${buttonIcon}`}></i>
                </button>
            </div>
        </div>
        </form>);
    }
}

export default SendMessage;