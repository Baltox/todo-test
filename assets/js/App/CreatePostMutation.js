import {graphql, commitMutation} from 'react-relay';

// We start by defining our mutation from above using `graphql`
const mutation = graphql`    
    mutation CreatePostMutation($input: CreatePostInput!) {
        createPost(input: $input) {
            post {
                id
                title
            }
        }
    }
`;

function commit(
    environment,
    postTitle,
) {
    // Now we just call commitMutation with the appropriate parameters
    return commitMutation(
        environment,
        {
            mutation,
            variables: {
                input: {postTitle},
            },
        }
    );
}

export default {commit};