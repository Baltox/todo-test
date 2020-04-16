import React from 'react';
import PropTypes from 'prop-types';

import {graphql, createFragmentContainer} from 'react-relay';

class Post extends React.Component {
    render() {
        const {post} = this.props;

        return <li key={post.id}>
            N° {post.id} : {post.title}<br/>
            Likes : {post.likes.map( like =>
                <div key={like.name}>{like.name}</div>
            )}
        </li>
    }
}

export default createFragmentContainer(
    Post,
    // Each key specified in this object will correspond to a prop available to the component
    {
        post: graphql`
            # As a convention, we name the fragment as '<ComponentFileName>_<propName>'
            fragment Post_post on Post {
                id
                title,
                likes {
                    name
                }
            }
        `
    },
)

Post.propTypes = {
    post: PropTypes.object
};