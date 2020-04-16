import React from 'react';
import {createFragmentContainer, createPaginationContainer, graphql, QueryRenderer} from 'react-relay';
import Environment from './Environment';
import Post from "./Post";
import CreatePostMutation from "./CreatePostMutation";

const managePostsQuery = graphql`    
    query AppQuery(
        $count: Int!
        $cursor: String
        #$orderBy: [FriendsOrdering]!
        #$userID: ID!
    ) {
        #...App_posts @arguments(count: $count, cursor: $cursor, orderBy: $orderBy)
        ...App_root @arguments(count: $count, cursor: $cursor)
    }
`;

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
            query={managePostsQuery}
            variables={{count: 3}}
            render={({error, props}) => {
                if (error) {
                    return <div>Error!</div>;
                }
                if (!props) {
                    return <div>Loading...</div>;
                }

                const {posts} = props;

                return (
                    <>
                        <PaginatedPost root={props}/>
                        <input type={"text"} size={50} value={this.state.postTitle} onChange={this.handleChange} />
                        <button onClick={this.handleClick}>Poster</button>
                    </>
                );
            }}
        />
    );
    }
}

const PaginatedPost = createPaginationContainer(
    (props) => (
        <>
            {console.log(props.relay.hasMore(), props.relay.isLoading())}

            <ul>
                {props.root.posts.edges.map(edge =>
                    <Post key={edge.node.id} post={edge.node}/>
                )}
            </ul>

            {props.relay.hasMore() &&
                <div
                    onClick={() =>
                        !props.relay.isLoading() &&
                        props.relay.loadMore(3)}>
                    Load more
                </div>
            }
        </>
    ),
    {
        root: graphql`            
            fragment App_root on Query
            #fragment Feed_user on User
            @argumentDefinitions(
                count: {type: "Int"}
                cursor: {type: "String"}
                #orderby: {type: "[FriendsOrdering]", defaultValue: [DATE_ADDED]}
            ) {
                posts(
                    first: $count
                    after: $cursor
                    #orderby: $orderBy # Non-pagination variables
                ) @connection(key: "App_posts") {
                    edges {
                        node {
                            id
                            ...Post_post
                        }
                    }
                }
            }
        `,
    },
    {
        direction: 'forward',
        getConnectionFromProps(props) {
            return props.root && props.root.posts;
        },
        // This is also the default implementation of `getFragmentVariables` if it isn't provided.
        getFragmentVariables(prevVars, totalCount) {
            return {
                ...prevVars,
                count: totalCount,
            };
        },
        getVariables(props, {count, cursor}, fragmentVariables) {
            return {
                count,
                cursor,
                //orderBy: fragmentVariables.orderBy,
                // userID isn't specified as an @argument for the fragment, but it should be a variable available for the fragment under the query root.
                //userID: fragmentVariables.userID,
            };
        },
        query: managePostsQuery
    }
)