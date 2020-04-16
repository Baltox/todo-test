/*
import React from 'react';
import {graphql, QueryRenderer} from 'react-relay';
import Environment from './Environment';
import Post from "./Post";
import CreatePostMutation from "./CreatePostMutation";

export default class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {postTitle: ''};
        this.handleChange = this.handleChange.bind(this);
        this.handleClick = this.handleClick.bind(this);
    }

    handleChange(e) {
        this.setState({postTitle: e.target.value});
    }

    handleClick() {
        let postTitle = this.state.postTitle;

        CreatePostMutation.commit(
            Environment,
            postTitle
        );

    }

    render() {
        return (
            <QueryRenderer
            environment={Environment}
            query={graphql`
              query AppQuery {
                posts {
                    id,
                    ...Post_post
                }  
              }
            `}
            variables={{}}
            render={({error, props}) => {
                if (error) {
                    return <div>Error!</div>;
                }
                if (!props) {
                    return <div>Loading...</div>;
                }

                const posts = props.posts;

                return (
                    <>
                        <ul>
                            {posts.map(post =>
                                <Post key={post.id} post={post}/>
                            )}
                        </ul>
                        <input type={"text"} size={50} value={this.state.postTitle} onChange={this.handleChange} />
                        <button onClick={this.handleClick}>Poster</button>
                    </>
                );
            }}
        />
    );
    }
}
 */