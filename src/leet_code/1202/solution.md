# LeetCode 1202. Smallest String With Swaps

> You are given a string s, and an array of pairs of indices in the string pairs where pairs[i] = [a, b] indicates 2 indices(0-indexed) of the string.

> You can swap the characters at any pair of indices in the given pairs any number of times.

> Return the lexicographically smallest string that s can be changed to after using the swaps.

- https://leetcode.com/problems/smallest-string-with-swaps/description/

##  Entendendo o problema

Se um caracter está presente num par, podemos dizer que ele está presente num grupo.

Um mesmo caracter não pode estar em dois grupos diferentes ao mesmo tempo.
Porque se dois pares possuem o mesmo caracter, essses dois pares formam um único grupo, já que podemos movimentar os caracteres entre os pares, qualquer número de vezes. 

Esse problema casa muito bem com um Disjoint Set, já que os pares vão compor diversos conjuntos.

### Exemplo:

```txt
string: dcab
pares: [0,3], [1, 2], [0, 2]
```

- Pra essa string, as letras `d` e `b` formam um par, então podem ser colocadas no mesmo grupo:

```txt
grupo 1: d, b
```

- As letras `c` e `a` também foram um par, mas essas letras não estão presentes no grupo 1. Então:

```txt
grupo 1: d, b
grupo 2: c, a
```

- Por fim, o último par é composto por `d` e `a`. A letra `d` está presente no grupo 1. E a letra `a` está presente  no grupo dois. 
Isso faz os dois grupos se unirem, porque agora existe uma ligação entre eles, através da conexão `d` para `a`.
Então, por fim, temos um grupo só pra essa string:

```txt
grupo 1: d, b, c, a
```

Então dá pra entender que podemos movimentar os caracteres de qualquer par, quantas vezes quisermos, desde que eles estejam "conectados" através de pares. 
E por fim, o enunciado pede que retornemos a menor string ordenadda lexograficamente(em ordem alfabetica) que pode ser formada através dessas movimentações.


###  Implementando a solução


Para resolver esse problema, eu converti a string num array e implementei um Disjoint Set básico (que também é conheciod como Union-Find).

```php
    $stringArray = str_split($s);
    $size = count($stringArray);
    $this->initDisjointSet($size, $pairs);
    $groups = [];    
```

Percorri cada par dado e adicionei os pares no Disjoint Set.

```php
    private function initDisjointSet($size, $pairs)
    {
        // Fill disjoint set
        for ($i = 0; $i < $size; $i++) {
            $this->disjointSet[$i] = $i;
        }

        foreach ($pairs as $pair) {
            $this->union($pair[0], $pair[1]);
        }
    }
```

Depois, percorri cada elemento do Disjoint Set e comecei a organizar os grupos.

```php
    foreach ($this->disjointSet as $element => $root) {
        $groups[$this->find($element)][$element] = $stringArray[$element];
    }
```

Esse grupo é um hash map, onde a chave é a RAIZ do elemento no Disjoint Set e dentro de cada Raiz, temos o mapeamento: índice -> caracter.
- Índice: posição do caracter na string original
- Caracter: auto-explicativo

Então, com base no exemplo dado acima, temos os seguintes grupos:

```php
    [
       0 => [
        0 => d,
        1 => b,
        2 => c,
        3 => a,
       ]
    ]
```

Uma vez que os caracteres estão agrupados, podemos ordená-los alfabeticamente.


```php
    foreach ($groups as $key => $group) {
        sort($groups[$key], SORT_ASC);
    }
```

```php
    [
       0 => [
        0 => a,
        1 => b,
        2 => c,
        3 => d,
       ]
    ]
```

Com os grupos em ordem alfabética, podemos percorrer novamente a string original e substituir cada caracter da string original, pelo caracter inicial do seu respectivo grupo. 
E depois removemos esse caracter do grupo.

```php
    $string = '';
    for ($i = 0; $i < $size; $i++) {
        $character = array_shift($groups[$this->find($i)]);
        $string = $string . $character;
    }
```

No PHP, usando o array_shift, eu consigo remover o primeiro caracter de cada grupo e a função retorna o elemento.  

Por fim, a nova string é enriquecida e retornada ao final. 

Código final:
```php
class Exercicio1202
{
    private array $disjointSet = [];

    /**
     * @param String $s
     * @param Integer[][] $pairs
     * @return String
     */
    function smallestStringWithSwaps($s, $pairs) {
        $stringArray = str_split($s);
        $size = count($stringArray);
        $this->initDisjointSet($size, $pairs);
        $groups = [];

        foreach ($this->disjointSet as $element => $root) {
            $groups[$this->find($element)][$element] = $stringArray[$element];
        }

        foreach ($groups as $key => $group) {
            sort($groups[$key], SORT_ASC);
        }

        $string = '';
        for ($i = 0; $i < $size; $i++) {
            $character = array_shift($groups[$this->find($i)]);
            $string = $string . $character;
        }

        return $string;
    }

    function union($x, $y) {
        $rootX = $this->find($x);
        $rootY = $this->find($y);

        if ($rootY != $rootX) {
            $this->disjointSet[$rootY] = $rootX;
        }
    }

    function find($x)
    {
        if ($this->disjointSet[$x] == $x) return $x;

        return $this->disjointSet[$x] = $this->find($this->disjointSet[$x]);
    }

    private function initDisjointSet($size, $pairs)
    {
        // Fill disjoint set
        for ($i = 0; $i < $size; $i++) {
            $this->disjointSet[$i] = $i;
        }

        foreach ($pairs as $pair) {
            $this->union($pair[0], $pair[1]);
        }
    }
}
```
