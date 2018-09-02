import React, {Component} from 'react';
import ReactDOM from 'react-dom';

class BookList extends Component {

    constructor(props) {
        super(props);
        this.state = {
            addBookForm: false,
            bookName: '',
            foundBooks: [],
            books: []
        };
    }

    bookForm() {
        return (<div>
                <div className="input-group mb-3">
                    <input type="text" className="form-control" value={this.state.bookName}
                           onChange={this.handleBookSearch.bind(this)}/>
                    <div className="input-group-append">
                        <button className="btn btn-outline-secondary" type="button">
                            <i className="fa fa-book"></i>
                            <i className="fa fa-plus-circle add-button"></i>
                        </button>
                    </div>
                </div>
                {this.foundBooks()}
            </div>

        );
    }

    async handleBookSearch(event) {

        this.setState({bookName: event.target.value});

        if (event.target.value.length < 4) {
            return false;
        }

        const params = {
            term: event.target.value
        };

        let search = await window.axios.get('/api/books/search', { params });

        let foundBooks = search.data.map(({id, title, author, source}) => {
            return {
                id, title, author, source,
                book: `${title} - ${author}`
            };
        });

        this.setState({foundBooks});
    }

    async addBook(bookId) {
        let addedBook = this.state.foundBooks.filter(({id}) => +id === +bookId)[0];

        let request = await window.axios.post(`/api/profile/books/${this.props.type}`, addedBook);

        let foundBooks = this.state.foundBooks.filter(({id}) => +id !== +request.data.book.id);

        this.setState({foundBooks, bookName: '', addBookForm: false});

        this.setState(prevState => ({
            books: [...prevState.books, request.data.book]
        }));
    }

    foundBooks() {

        if (this.state.foundBooks.length === 0) {
            return null;
        }

        const foundBooks = this.state.foundBooks.map((book, index) =>
            <li className="list-group-item" key={index} onClick={() => this.addBook(book.id)}>
                {book.book}
            </li>
        );

        return <ul className="list-group found-books">{foundBooks}</ul>;
    }

    addButton() {
        return (<div style={{textAlign: 'right', paddingRight: '5px'}}
                     onClick={() => this.setState({addBookForm: true})}>
                <i className="fa fa-plus-square"></i>
            </div>
        );
    }

    deleteBook(bookId) {
        window.axios.delete(`/api/profile/books/${this.props.type}/${bookId}`)
            .then(() => this.setState({books: this.state.books.filter(({id}) => id !== bookId)}));
    }

    componentDidMount() {
        window.axios(`/api/profile/books/${this.props.type}`)
            .then(({data}) => this.setState({books: data.books}));
    }

    render() {
        const books = this.state.books.map((book, index) =>
            <li className="list-group-item" key={index}>
                {book.title} by {book.author}
                <span className="book-delete" onClick={() => this.deleteBook(book.id)}>
                    <i className="fa fa-minus-circle"></i>
                </span>
            </li>
        );

        const bookForm = this.state.addBookForm ? this.bookForm() : '';

        return (
            <div className="booklist-container">
                <h4>{this.props.type} Books</h4>

                <ul className="list-group">
                    {books}
                </ul>

                {this.addButton()}

                {bookForm}

            </div>
        );
    }
}

export default BookList;
