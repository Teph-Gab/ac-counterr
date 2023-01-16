import { defineAbility } from '@casl/ability';

export default (user) => defineAbility((can, cannot) => {

  if (user[0].roles[0].name == 'super-admin') {
    can('manage', 'all', { authorId: user.id });
  }
  else if (user[0].roles[0].name == 'admin') {
    can('read', 'all', { authorId: user.id });
    can('update', 'all', { authorId: user.id });
  }
  else{
    cannot('manage', 'all', { authorId: user.id });
  }
});