/**
 * @flow
 */

/* eslint-disable */

'use strict';

/*::
import type { ReaderFragment } from 'relay-runtime';
import type { FragmentReference } from "relay-runtime";
declare export opaque type Post_post$ref: FragmentReference;
declare export opaque type Post_post$fragmentType: Post_post$ref;
export type Post_post = {|
  +id: string,
  +title: string,
  +likes: $ReadOnlyArray<{|
    +name: string
  |}>,
  +$refType: Post_post$ref,
|};
export type Post_post$data = Post_post;
export type Post_post$key = {
  +$data?: Post_post$data,
  +$fragmentRefs: Post_post$ref,
  ...
};
*/


const node/*: ReaderFragment*/ = {
  "kind": "Fragment",
  "name": "Post_post",
  "type": "Post",
  "metadata": null,
  "argumentDefinitions": [],
  "selections": [
    {
      "kind": "ScalarField",
      "alias": null,
      "name": "id",
      "args": null,
      "storageKey": null
    },
    {
      "kind": "ScalarField",
      "alias": null,
      "name": "title",
      "args": null,
      "storageKey": null
    },
    {
      "kind": "LinkedField",
      "alias": null,
      "name": "likes",
      "storageKey": null,
      "args": null,
      "concreteType": "User",
      "plural": true,
      "selections": [
        {
          "kind": "ScalarField",
          "alias": null,
          "name": "name",
          "args": null,
          "storageKey": null
        }
      ]
    }
  ]
};
// prettier-ignore
(node/*: any*/).hash = '272407fa0aab56f3baea2bfc395715c7';

module.exports = node;
