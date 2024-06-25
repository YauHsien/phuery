
```
require 'Table.php';
require 'Join.php';
require 'Query.php';

$query = Query::new()->
    select(['a','b'])->
    from('T')->
    where('a = b')->
    where('a <> b');

echo $query->getSQL();

/*
 * 印出
 * SELECT a, b FROM T WHERE a = b and a <> b
 */

```